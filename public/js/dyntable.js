function expandDynTable(tableid, id) {
    const tableEl = document.getElementById(globalDataDynTable[tableid].tableElNameDynTable)
    const tableBody = tableEl.querySelector('.DynTableBody')
    let loopEl = tableBody.firstElementChild
    while (loopEl.getAttribute('data-id') != id) {
        loopEl = loopEl.nextElementSibling
    }

    let collapsing = loopEl.getAttribute('data-expanded') === '1'
    loopEl.setAttribute('data-expanded', collapsing ? '0' : '1')

    while (loopEl && (loopEl.getAttribute('data-id') == id)) {
        loopEl = loopEl.nextElementSibling
    }

    if (collapsing) {
        loopEl.remove()
    } else {
        let newEl = document.createElement('div')
        newEl.style.gridColumn = '1 / span ' +
            (Object.entries(globalDataDynTable[tableid].columnsDynTable).length + (globalDataDynTable[tableid].expandRowDynTable == true ? 1 : 0) + (globalDataDynTable[tableid].editRowDynTable == true ? 1 : 0))
        newEl.innerHTML = (globalDataDynTable[tableid].optionsDynTable.expandFormatter)

        if (typeof globalDataDynTable[tableid].optionsDynTable.expandFormatter === 'function') {
            let retFormatter = (globalDataDynTable[tableid].optionsDynTable.expandFormatter)(id, newEl)
            if (retFormatter && (typeof retFormatter === 'object') && (retFormatter !==
                null)) {
                newEl.appendChild(retFormatter)
            } else {
                newEl.innerHTML = retFormatter
            }
        } else {
            newEl.innerHTML = value
        }

        if (loopEl) {
            tableBody.insertBefore(newEl, loopEl)
        } else {
            tableBody.appendChild(newEl)
        }
    }
}

function setRowPerPageDynTable(el) {
    el.parentNode.setAttribute('data-selection', el.getAttribute('data-selection'))
    el.parentNode.parentNode.querySelector('button').innerHTML = el.getAttribute('data-selection')
    let tableid = el.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.getAttribute('data-dyntable-id')
    updateDynTable(tableid)
}

function headerClickDynTable(ev, srcEl, tableid) {
    const curSort = srcEl.querySelector('.DynTableSort').innerHTML.trim()
    const tableEl = document.getElementById(globalDataDynTable[tableid].tableElNameDynTable)
    const tableBody = tableEl.querySelector('.DynTableBody')

    for (const el of tableEl.querySelectorAll('.DynTableSort')) {
        el.innerHTML = ''
    }
            // ⤋⤊

    tableBody.setAttribute('data-sort', srcEl.getAttribute('data-col-name'))
    if (curSort === '') {
        tableBody.setAttribute('data-order','ASC')
        srcEl.querySelector('.DynTableSort').innerHTML = '⤊'
    }
    if (curSort === '⤊') {
        tableBody.setAttribute('data-order','DESC')
        srcEl.querySelector('.DynTableSort').innerHTML = '⤋'
    }
    if (curSort === '⤋') {
        tableBody.setAttribute('data-order','ASC')
        srcEl.querySelector('.DynTableSort').innerHTML = ''
    }

    updateDynTable(tableid)
}

function rowClickDynTable(ev, srcEl, tableid) {
    if (typeof globalDataDynTable[tableid].optionsDynTable.clickRowCallback === 'function') {
        globalDataDynTable[tableid].optionsDynTable.clickRowCallback(ev, srcEl)
    }
}

function rowEditBtnCLickDynTable(ev, srcEl, tableid) {
    const tableEl = document.getElementById(globalDataDynTable[tableid].tableElNameDynTable)
    ev.stopPropagation()
    const tgtEl = ev.currentTarget
    const rowEl = tableEl.querySelectorAll('[data-id="' + tgtEl.getAttribute('data-id') + '"]')
    if (!tgtEl.getAttribute('data-editing')) {
        tgtEl.setAttribute('data-editing', '1')
        for (let el of rowEl) {
            el.classList.add('dyntable-editing')
        }
    } else {
        tgtEl.removeAttribute('data-editing')
        for (let el of rowEl) {
            el.classList.remove('dyntable-editing')
        }
    }
    if (typeof globalDataDynTable[tableid].optionsDynTable.editButtonCallback === 'function') {
        globalDataDynTable[tableid].optionsDynTable.editButtonCallback(ev, srcEl, tableid)
    }
}


function updateDynTable(table, { searchparam, pageparam } = {}) {
    let tableid = table
    if (typeof table === 'object') {
        tableid = globalDataDynTable[table.id]
    }
    const tableEl = document.getElementById(globalDataDynTable[tableid].tableElNameDynTable)
    const tableBody = tableEl.querySelector('.DynTableBody')
    const tablePageButtons = tableEl.querySelector('#tablePageButtons')
    const tablePageDropdown = tableEl.querySelector('#tablePageDropdown')
    const rowPerPage = tableEl.querySelector('#tablePageDropdown').getAttribute('data-selection') * 1

    const search = tableEl.querySelector('#searchDynTable').value
    const sort = tableBody.getAttribute('data-sort')
    const order = tableBody.getAttribute('data-order')
    const page = pageparam > 0 ? pageparam : tableBody.getAttribute('data-page') * 1

    const tgtUrl = tableEl.getAttribute('data-url') +
        '?search=' + search +
        '&sort=' + sort +
        '&order=' + order +
        '&offset=' + ((page - 1) * rowPerPage) +
        '&limit=' + rowPerPage +
        (globalDataDynTable[tableid].additionalRequestDynTable ? globalDataDynTable[tableid].additionalRequestDynTable() : '')
    // '&cat=' + cat +
    // '&keyword=' + keyword +
    // '&json'

    fetch(tgtUrl, {
        headers: globalDataDynTable[tableid].requestHeaderDynTable,
        method: "get",
    })
        .then(res => res.json())
        .then(res => {
            let colNames = []
            const dataColEl = tableEl.querySelector('.DynTableHeader')
                .getElementsByClassName('col-data-column')
            for (let i = 0; i < dataColEl.length; i++) {
                colNames.push(dataColEl.item(i).getAttribute('data-col-name'))
            }

            tableBody.setAttribute('data-page', page)
            const noPages = Math.ceil(res.total / tablePageDropdown.getAttribute('data-selection'))
            const curPage = tableBody.getAttribute('data-page') * 1
            const pageToRightTemp = curPage + 4 > noPages ? noPages - curPage : 4
            const pageToLeftTemp = curPage > 4 ? 4 : curPage - 1
            let pageToRight = pageToRightTemp + 4 - pageToLeftTemp
            let pageToLeft = pageToLeftTemp + 4 - pageToRightTemp
            if (curPage - pageToLeft < 1) {
                pageToLeft = curPage - 1
            }
            if (curPage + pageToRight > noPages) {
                pageToRight = noPages - curPage
            }

            let refBut = tablePageButtons.firstElementChild
            while (refBut.nextElementSibling) {
                let refButTemp = refBut.nextElementSibling
                if (!refBut.hasAttribute('data-fixed')) {
                    refBut.remove()
                }
                refBut = refButTemp
            }

            refBut = tableBody.firstElementChild
            while (refBut) {
                let refButTemp = refBut.nextElementSibling
                refBut.remove()
                refBut = refButTemp
            }

            refBut = tablePageButtons.lastElementChild

            for (let i = curPage + pageToRight; i > curPage; i--) {
                let newEl = document.createElement('button')
                newEl.type = 'button'
                newEl.classList.add('btn', 'btn-primary')
                newEl.innerHTML = i
                newEl.setAttribute('data-value', i)
                newEl.setAttribute('onclick', 'updateDynTable(' + tableid + ', {pageparam:' + i + '})')
                tablePageButtons.insertBefore(newEl, refBut)
                refBut = newEl
            }

            let newEl = document.createElement('button')
            newEl.type = 'button'
            newEl.classList.add('btn', 'btn-secondary')
            newEl.innerHTML = curPage
            newEl.setAttribute('data-value', curPage)
            // newEl.setAttribute('onclick', 'updateDynTable({pageparam:'+curPage+'})')
            tablePageButtons.insertBefore(newEl, refBut)
            refBut = newEl

            for (let i = curPage - 1; i >= curPage - pageToLeft; i--) {
                let newEl = document.createElement('button')
                newEl.type = 'button'
                newEl.classList.add('btn', 'btn-primary')
                newEl.innerHTML = i
                newEl.setAttribute('data-value', i)
                newEl.setAttribute('onclick', 'updateDynTable(' + tableid + ', {pageparam:' + i + '})')
                tablePageButtons.insertBefore(newEl, refBut)
                refBut = newEl
            }

            res.data.forEach(el => {
                function cekColumn(obj, prefix) {
                    let prefixstr
                    if (prefix)
                        prefixstr = prefix + '.'
                    else
                        prefixstr = ''

                    for (const [key, value] of Object.entries(obj)) {
                        if ((typeof value === 'object') && value) {
                            cekColumn(value, prefixstr + key)
                        } else if (globalDataDynTable[tableid].columnsDynTable[prefixstr + key]) {
                            let colNo = globalDataDynTable[tableid].columnsDynTable[prefixstr + key].position + (globalDataDynTable[tableid].expandRowDynTable == true ? 1 : 0)
                            let newEl = document.createElement('div')
                            newEl.classList.add('colDynTable', 'colDynTable-' + colNo)
                            if (globalDataDynTable[tableid].columnsDynTable[prefixstr + key].cssClass) {
                                globalDataDynTable[tableid].columnsDynTable[prefixstr + key].cssClass.split(' ').forEach((classEl) => {
                                    newEl.classList.add(classEl)
                                })
                            }
                            newEl.setAttribute('data-id', el.id)
                            if (typeof globalDataDynTable[tableid].optionsDynTable.colFormatter[prefixstr + key] === 'function') {
                                let retFormatter = (globalDataDynTable[tableid].optionsDynTable.colFormatter[prefixstr + key])(value, newEl, obj)
                                if (retFormatter && (typeof retFormatter === 'object') && (retFormatter !==
                                    null)) {
                                    newEl.appendChild(retFormatter)
                                } else {
                                    newEl.innerHTML = retFormatter
                                }
                            } else {
                                newEl.innerHTML = value
                            }
                            if (typeof globalDataDynTable[tableid].optionsDynTable.clickRowCallback === 'function') {
                                newEl.addEventListener('click', (ev)=>{rowClickDynTable(ev, newEl, tableid)})
                            }
                            tableBody.appendChild(newEl)
                        }
                    }
                }
                if (globalDataDynTable[tableid].expandRowDynTable) {
                    let newEl = document.createElement('div')
                    newEl.classList.add('colDynTable-1', 'colDynTable')
                    newEl.innerHTML = `
                        <svg class="svg-icon" viewBox="0 0 20 20">
							<path d="M17.659,9.597h-1.224c-0.199-3.235-2.797-5.833-6.032-6.033V2.341c0-0.222-0.182-0.403-0.403-0.403S9.597,2.119,9.597,2.341v1.223c-3.235,0.2-5.833,2.798-6.033,6.033H2.341c-0.222,0-0.403,0.182-0.403,0.403s0.182,0.403,0.403,0.403h1.223c0.2,3.235,2.798,5.833,6.033,6.032v1.224c0,0.222,0.182,0.403,0.403,0.403s0.403-0.182,0.403-0.403v-1.224c3.235-0.199,5.833-2.797,6.032-6.032h1.224c0.222,0,0.403-0.182,0.403-0.403S17.881,9.597,17.659,9.597 M14.435,10.403h1.193c-0.198,2.791-2.434,5.026-5.225,5.225v-1.193c0-0.222-0.182-0.403-0.403-0.403s-0.403,0.182-0.403,0.403v1.193c-2.792-0.198-5.027-2.434-5.224-5.225h1.193c0.222,0,0.403-0.182,0.403-0.403S5.787,9.597,5.565,9.597H4.373C4.57,6.805,6.805,4.57,9.597,4.373v1.193c0,0.222,0.182,0.403,0.403,0.403s0.403-0.182,0.403-0.403V4.373c2.791,0.197,5.026,2.433,5.225,5.224h-1.193c-0.222,0-0.403,0.182-0.403,0.403S14.213,10.403,14.435,10.403"></path>
						</svg>
                       `
                    newEl.setAttribute('onclick', 'expandDynTable(' + tableid + ', ' + el.id + ')')
                    newEl.setAttribute('data-id', el.id)
                    tableBody.appendChild(newEl)
                }
                cekColumn(el, '')

                if (globalDataDynTable[tableid].editRowDynTable) {
                    newEl = document.createElement('div')
                    newEl.classList.add('colDynTable', 'colDynTable-' + (1 + Object.keys(globalDataDynTable[tableid].columnsDynTable).length + (globalDataDynTable[tableid].expandRowDynTable == true ? 1 : 0)))
                    newEl.setAttribute('data-id', el.id)
                    newEl.innerHTML =
                        `
<svg class="svg-icon" viewBox="0 0 20 20">
    <path
       d="M 15.675781 -0.40429688 L 15.675781 -0.27929688 L 15.707031 -0.27929688 L 15.707031 -0.40429688 L 15.675781 -0.40429688 z M 13.859375 3.0214844 C 13.517384 3.022795 13.17488 3.1512669 12.917969 3.4101562 L 3.9550781 12.443359 A 0.50005 0.50005 0 0 0 3.8203125 12.699219 L 3.0175781 16.787109 A 0.50005 0.50005 0 0 0 3.15625 17.238281 A 0.50005 0.50005 0 0 0 3.6074219 17.375 L 7.6875 16.556641 A 0.50005 0.50005 0 0 0 7.9433594 16.417969 L 16.916016 7.3769531 C 17.429839 6.8591755 17.42598 6.0079644 16.908203 5.4941406 L 14.802734 3.4042969 C 14.543845 3.1473848 14.201366 3.0201737 13.859375 3.0214844 z M 13.863281 4.0117188 C 13.946597 4.0113997 14.029247 4.0453946 14.097656 4.1132812 L 16.203125 6.203125 C 16.339945 6.3388999 16.340854 6.5370074 16.205078 6.6738281 L 15.164062 7.7226562 L 12.587891 5.1640625 L 13.628906 4.1152344 C 13.696794 4.0468241 13.779965 4.0120378 13.863281 4.0117188 z M 11.882812 5.875 L 14.458984 8.4316406 L 7.3417969 15.605469 L 4.1445312 16.248047 L 4.7734375 13.039062 L 11.882812 5.875 z M 12.351562 7.3652344 A 0.5 0.5 0 0 0 12.126953 7.4960938 L 7.03125 12.632812 A 0.5 0.5 0 0 0 7.0332031 13.339844 A 0.5 0.5 0 0 0 7.7402344 13.337891 L 12.837891 8.2011719 A 0.5 0.5 0 0 0 12.835938 7.4941406 A 0.5 0.5 0 0 0 12.609375 7.3652344 A 0.5 0.5 0 0 0 12.351562 7.3652344 z M 9.7070312 16.384766 A 0.5 0.5 0 0 0 9.2070312 16.884766 A 0.5 0.5 0 0 0 9.7070312 17.384766 L 18.464844 17.384766 A 0.5 0.5 0 0 0 18.964844 16.884766 A 0.5 0.5 0 0 0 18.464844 16.384766 L 9.7070312 16.384766 z "
    />
</svg>
                    `
                    // `
                    //     <svg class="svg-icon" viewBox="0 0 20 20">
                    // 		<path d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
                    // 	</svg>
                    //     `
                    newEl.setAttribute('onclick', 'rowEditBtnCLickDynTable(event, this, ' + tableid + ')')
                    // newEl.onclick = rowEditBtnCLickDynTable
                    tableBody.appendChild(newEl)
                }
            });

        })
}

function initDynTable(options) {
    if (typeof tableCounterDynTable == 'undefined') {
        globalDataDynTable = [{}]
        tableCounterDynTable = 0
    } else {
        globalDataDynTable.push({})
        tableCounterDynTable++
    }
    globalDataDynTable[options.tableElement ?? ''] = tableCounterDynTable
    globalDataDynTable[tableCounterDynTable].optionsDynTable = options
    globalDataDynTable[tableCounterDynTable].tableElNameDynTable = options.tableElement ?? ''
    globalDataDynTable[tableCounterDynTable].requestHeaderDynTable = options.reqHeader ?? ''
    globalDataDynTable[tableCounterDynTable].additionalRequestDynTable = options.additionalRequestBuilder ?? null
    globalDataDynTable[tableCounterDynTable].columnsDynTable = options.columns ?? null
    globalDataDynTable[tableCounterDynTable].expandRowDynTable = options.expandRow ?? false
    globalDataDynTable[tableCounterDynTable].editRowDynTable = options.editRow ?? false

    const tableEl = document.getElementById(globalDataDynTable[tableCounterDynTable].tableElNameDynTable)

    let sortColumns = []

    for (const el of Object.entries(globalDataDynTable[tableCounterDynTable].columnsDynTable)) {
        sortColumns.push(el)
    }

    sortColumns.sort(function (a, b) {
        return a[1].position > b[1].position;
    });

    let gridTemplateColumnsStr = (globalDataDynTable[tableCounterDynTable].expandRowDynTable ? 'auto ' : '')
    sortColumns.forEach((el) => {
        gridTemplateColumnsStr += el[1].width + ' '
    })
    gridTemplateColumnsStr += (globalDataDynTable[tableCounterDynTable].editRowDynTable ? '60px' : '')

    let newEl = document.createElement('div')
    // newEl.classList.add('container')
    newEl.classList.add('DynTableContainer')
    newEl.style.height = '100%'
    newEl.innerHTML = `
    <div class="DynTableSearch">
        <div class="col-4 my-2">
            <input type="text" oninput="updateDynTable(this.parentNode.parentNode.parentNode.parentNode.getAttribute('data-dyntable-id'))" placeholder="Cari tabel..."
                class="form-control" id="searchDynTable">
        </div>
    </div>
        <div class="col-12 DynTableHeader">
            </div>
        </div>


        <div class="col-12 DynTableBody" data-page="1" data-sort="id" data-order="asc"
        style="
        height: 100%;
        overflow-y: scroll;
        overflow-x: hidden;
        "
        >

        </div>

    <div class="DynTableFooter">
            <div class="col-6">
                Baris per halaman

                <div class="btn-group dropup">
                    <button id="pageDropDownButton" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        10
                    </button>
                    <div id="tablePageDropdown" class="dropdown-menu" data-selection="10" aria-labelledby="pageDropDownButton">
                        <button class="dropdown-item" onclick="setRowPerPageDynTable(this)"
                            data-selection="10">10
                        </button>
                        <button class="dropdown-item" onclick="setRowPerPageDynTable(this)"
                            data-selection="25">25
                        </button>
                        <button class="dropdown-item" onclick="setRowPerPageDynTable(this)"
                            data-selection="50">50
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <div id="tablePageButtons" class="btn-group" role="group" aria-label="Table Page Navigation">
                    <button type="button" class="btn btn-primary" data-fixed="true">«</button>
                    <button type="button" class="btn btn-primary" data-fixed="true">»</button>
                </div>
            </div>
        </div>
    </div>

    `
    tableEl.appendChild(newEl)
    let parentEl = newEl

    let curCol = 1

    if (globalDataDynTable[tableCounterDynTable].expandRowDynTable) {
        newEl = document.createElement('div')
        newEl.classList.add('colDynTable', 'colDynTable-1')
        parentEl.querySelector('.DynTableHeader').appendChild(newEl)
        curCol++
    }

    sortColumns.forEach((el) => {
        newEl = document.createElement('div')
        newEl.classList.add('colDynTable', 'colDynTable-' + curCol, 'col-data-column')
        newEl.setAttribute('data-col-name', el[0])
        newEl.innerHTML = el[1].label
        const sortEl = document.createElement('div')
        sortEl.innerHTML = ''
        // ⤋⤊
        sortEl.classList.add('DynTableSort')
        newEl.appendChild(sortEl)
        newEl.setAttribute('onclick', 'headerClickDynTable(event, this, ' + tableCounterDynTable + ')')
        parentEl.querySelector('.DynTableHeader').appendChild(newEl)
        curCol++
    })

    if (globalDataDynTable[tableCounterDynTable].editRowDynTable) {
        newEl = document.createElement('div')
        newEl.classList.add('colDynTable', 'colDynTable-' + curCol)
        newEl.innerHTML = 'Edit'
        parentEl.querySelector('.DynTableHeader').appendChild(newEl)
    }

    tableEl.querySelector(".DynTableHeader").style.gridTemplateColumns = gridTemplateColumnsStr
    tableEl.querySelector(".DynTableBody").style.gridTemplateColumns = gridTemplateColumnsStr

    tableEl.querySelector(".DynTableHeader").style.gridAutoRows = options.gridAutoRows
    tableEl.querySelector(".DynTableBody").style.gridAutoRows = options.gridAutoRows
    // tableEl.querySelector(".DynTableBody").parentNode.style.height = 'calc('+tableEl.querySelector(".DynTableBody").parentNode.offsetHeight+'px  -  3 * ' + options.gridAutoRows

    tableEl.setAttribute('data-DynTable-id', tableCounterDynTable)

    updateDynTable(tableCounterDynTable)
}
