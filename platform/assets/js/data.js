const fetchData = (id, start) => {
    fetch('https://www.okul.pwc.com.tr/platform/include/api.php')
    .then(response => response.json())
    .then(data => {
        const tbodyRef = document.getElementById(`${id}`);
        let rowBuilder = "";
        for(let item of data)
        {
            const startTime = item.start.replace(':', '');
            let selectedItem = localStorage.getItem(startTime) ? JSON.parse(localStorage.getItem(startTime)) : null;
            const selected = selectedItem?.id == item.id;
            item['selected'] = selected;
            if(item.start !== start){continue;}
            rowBuilder += generateRow(item);
            let newWorkshop = document.getElementById(id);
            newWorkshop += generateWorkshop(item);
        }
        tbodyRef.innerHTML = rowBuilder;
    })
    .catch(error => console.log(error));
}
const fetchMasterData = (id) => {
    fetch('https://www.okul.pwc.com.tr/platform/include/api.php')
    .then(response => response.json())
    .then(data => {
        const tbodyRef = document.getElementById(`${id}`);
        let rowBuilder = "";
        for(let item of data)
        {
            if(item.start == '11:00' || item.start == '14:00'){
                const startTime = item.start.replace(':', '');
                let selectedItem = localStorage.getItem(startTime) ? JSON.parse(localStorage.getItem(startTime)) : null;
                const selected = selectedItem?.id == item.id;
                item['selected'] = selected;
                rowBuilder += generateMaster(item);
            }
        }
        tbodyRef.innerHTML = rowBuilder;
    })
    .catch(error => console.log(error));
}
const fetchWorkshop = (id, start) => {
    fetch('https://www.okul.pwc.com.tr/platform/data/program.json')
    .then(response => response.json())
    .then(data => {
        for(let [index, item] of data.entries())
        {
            item['even'] = (index % 2 == 0);
            let newWorkshop = document.getElementById(`${id}`);
            newWorkshop.innerHTML += generateWorkshop(item);
        }
    })
    .catch(error => console.log(error));
}

const generateRow = ({start, end, title, speaker, selected, id, saloon, expection, image, pdf, video}) => {
    const startClass = start.replace(':', '');
    let speakerArray = speaker.split('#');
    speakerArray = speakerArray.map((item) => {
        let itemArray = item.split('-');
        return `<b>${itemArray[0]}</b> - <i>${itemArray[1]}</i>`;
    })
    let speakers = speakerArray.join('<br>');
    let img = 'https://www.okul.pwc.com.tr/platform/manage/admin/timetable/images/' + image;
    let video_empty = '';
    if(video === '#') {
        video_empty = 'display: none;';
    }
    let pdf_empty = '';
    console.log(pdf)
    if(pdf === 'https:\/\/www.okul.pwc.com.tr\/platform\/pdf\/' || pdf === 'http://www.okul.pwc.com.tr/platform/pdf/') {
        pdf_empty = 'display: none;';
    }


    
    return `<tr>
    <td class="session" data-title="Workshop Adı:">${title}</td>
    <td class="saloon" data-title="Salon Adı:">${saloon}</td>
    <td class="about" data-title="Konuşmacılar:"><div class="row align-items-center"><div class="col-md-9 col-xs-12">${speakers}</div>
        <div class="col-md-3 col-xs-12 feature">
            <a class="product-management mybtn brandingBtn" style='${pdf_empty}' href="${pdf}" target="_blank" data-id="${id}" data-start="${start}" data-end="${end}" data-title="${title}"><i class="fas fa-file-pdf"></i> Sunum</a>
            <a class="product-management mybtn brandingBtnTangerine d-none" style='${video_empty}' href="${video}" target="_blank" data-id="${id}" data-start="${start}" data-end="${end}" data-title="${title}"><i class="fab fa-youtube"></i> Video</a>
            <a class="product-management mybtn brandingBtn d-none" onClick="addProduct(this)" target="_blank" data-id="${id}" data-start="${start}" data-end="${end}" data-title="${title}"><i class="fas fa-plus"></i> Ekle</a>
            <a class="mybtn brandingBtnTangerine detailButton mt-2 d-none"><i class="fas fa-info-circle"></i> Detay</a>
        </div>
    </div></td>
   
            </tr>
            <tr class="event-sd">
            <td colspan="3">
                <div class="content" style="display:none;">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-12">
                            <div class="tdc-ls">
                            <p>${expection}</p>
                            </div>
                        </div>
                        <div class="col-lg-5 col-12">
                            <div class="tdc-rs d-flex flex-wrap align-items-center">
                                <div class="col-12 col-lg-12">
                                    <div class="tdc-thumb">
                                        <img src="${img}" alt="${title}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            </tr>`;
}

const buildMasterData = () => {
    fetch('https://www.okul.pwc.com.tr/platform/include/api.php')
    .then(response => response.json())
    .then(data => {
        for(let item of data)
        {
            if(item.start == '11:00' || item.start == '14:00'){
                const start = item.start.replace(':', '');
                const end = item.end.replace(':', '');
                const title = item.title;
                const id = item.id;
                let expiry = new Date();
                expiry.setHours(expiry.getHours() + 1);
                localStorage.setItem(start, JSON.stringify({start, end, title, expiry, id}));
            }
        }
        changeUI();
    })
    .catch(error => console.log(error));
}

const generateMaster = ({start, end, title, speaker, selected, id, saloon, expection, image, pdf, video}) => {
    const startClass = start.replace(':', '');
    let speakerArray = speaker.split('#');
    speakerArray = speakerArray.map((item) => {
        let itemArray = item.split('-');
        if(itemArray[0].includes('Konuşmacılar')) {
            itemArray[0] = "<span class='brandingColor'>" + itemArray[0].substring(0, 14) + "</span><br />" + itemArray[0].substring(14);
        }
        if(itemArray[0].includes('Açılış')) {
            itemArray[0] = "<span class='brandingColor'>" + itemArray[0].substring(0, 8) + "</span>" + itemArray[0].substring(8);
        }
        if(itemArray[0].includes('Moderatör')) {
            itemArray[0] = "<span class='brandingColor'>" + itemArray[0].substring(0, 11) + "</span>" + itemArray[0].substring(11);
        }
        return `<b>${itemArray[0]}</b> - <i>${itemArray[1]}</i>`;
    })
    let speakers = speakerArray.join('<br>');
    let img = 'https://www.okul.pwc.com.tr/platform/manage/admin/timetable/images/' + image;
    return `
    <div class="col-md-6 col-xs-12">
    <div class="card">
  <img class="card-img-top" src="${img}" alt="${title}">
  <div class="card-body" style="min-height: 250px !important">
    <h5 class="card-title">${title}</h5>
    <div>
        ${speakers}
        <ul class="d-none">
        <li>
            <div class="con-info-title">Başlangıç</div>
            <div class="con-info-text">20 Aralık ${start}</div>
        </li>
        <li>
            <div class="con-info-title">Bitiş</div>
            <div class="con-info-text">20 Aralık ${end}</div>
        </li>
    </div>
    <div class="col-xs-12 feature mt-4" style='float:left;'>
    
    <a class="product-management mybtn brandingBtnTangerine d-none" href="${video}" target="_blank" data-id="${id}" data-start="${start}" data-end="${end}" data-title="${title}"><i class="fab fa-video"></i> Video</a>

      <a class="product-management mybtn brandingBtn d-block" href="${pdf}" target="_blank" data-id="${id}" data-start="${start}" data-end="${end}" data-title="${title}"><i class="fa fa-file-pdf"></i> Sunum</a>
        </div>
</ul> 
  </div>
</div>
</div>`;
}

const generateWorkshop = ({start, end, title, speaker, even}) => {
    return `<div class="timeline-schedule ${even ? '' : 'flex-row-reverse'}">
    <div class="timeline-shape"></div>
    <div class="timeline-header ${even ? 'right' : 'left'}">
        <span style="font-weight:bold;" class="brandingColor">${start}-${end}</span>
        <h4>${title}</h4>
        <div class="meta-post">
           ${speaker}
        </div>
        
    </div>
    <div class="timeline-wrapper right">
        <div class="timeline-content">	    						
        </div>
    </div>
</div>`
}

const addProduct = (product) => {
    const start = product.dataset.start.replace(':', '');
    const end = product.dataset.end.replace(':', '');
    const title = product.dataset.title;
    const id = product.dataset.id;
    let expiry = new Date();
    expiry.setHours(expiry.getHours() + 1);
    if(localStorage.getItem(start))
    {
        toastr.error('Aynı saatte başlayan başka bir eğitimi seçtiniz, bu seçimi yapabilmek için lütfen önceki seçimi kaldırınız.');
    }
    else 
    {
        localStorage.setItem(start, JSON.stringify({start, end, title, expiry, id}));
        toastr.success('Oturum Eklenmiştir.');
        product.onclick = () => removeProduct(product);
        product.childNodes[0].className = "fas fa-minus";
        product.childNodes[1].data = " Çıkar";
        try {
            product.closest('tr').className = 'selected-product';
        } catch(err) {
            product.closest('li').className = 'selected-product';
        }
    }
    changeUI();
}

const removeProduct = (product) => {
    const start = product.dataset.start.replace(':', '');
    localStorage.removeItem(start);
    toastr.success('Oturum çıkarılmıştır.');
    product.childNodes[0].className = "fas fa-plus";
    product.childNodes[1].data = " Ekle";
    try {
        product.closest('tr').className = '';
    } catch(err) {
        product.closest('li').className = '';
    }
    product.onclick = () => addProduct(product);
    changeUI();
}

$(document).ready(function(){
    window.localStorage.clear();
    buildMasterData();
    builtRegisteredItems();
});


const changeUI = () => {
    updateSelectedVideos();
    builtRegisteredItems();
    checkItemsIfEmpty();
}

const checkItemsIfEmpty = () => {
    if(window.localStorage.length === 0)
    {
        $('#no-selected-item').show();
    } else {
        $('#no-selected-item').hide();
    }
}

const updateSelectedVideos = () => {
    const selectedVideos = [];
    let registeredCourses = {};
    Object.keys(localStorage).forEach(function(key){
        let item = localStorage.getItem(key);
        registeredCourses[`${key}`] = item;
     });
     let sortedID = Object.keys(registeredCourses).sort();
     for(let key of sortedID)
     {
        let item = JSON.parse(registeredCourses[key]);
        selectedVideos.push(item.id);
     }
    $('#selectedVideos').val(selectedVideos.join(','));
}


const builtRegisteredItems = () => {
    let listBuilder = '';
    let registeredCourses = {};
    Object.keys(localStorage).forEach(function(key){
        let item = localStorage.getItem(key);
        registeredCourses[`${key}`] = item;
     });
     let sortedID = Object.keys(registeredCourses).sort();
     for(let key of sortedID)
     {
        let item = JSON.parse(registeredCourses[key]);
        item['start'] = item['start'].slice(0, 2) + ":" + item['start'].slice(2)
        item['end'] = item['end'].slice(0, 2) + ":" + item['end'].slice(2)
        listBuilder += `<li class="schedule-list wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s">
                        <div class="time">${item.start} - ${item.end}</div>
                        <div class="esto"></div>
						<div class="details">${item.title}</div>
                        </li>
                    `;
     }
     document.getElementById('registered_items').innerHTML = listBuilder;
}

/*
const updateItemsOnLocalStorage = () => {
    let registeredCourses = {};
    Object.keys(localStorage).forEach(function(key){
        let item = localStorage.getItem(key);
        registeredCourses[`${key}`] = item;
     });
     window.localStorage.clear();
     for(let key in registeredCourses)
     {
        localStorage.setItem(key, registeredCourses[key]);
     }
}


setInterval(() => {
    clearExpiredItems();
    updateItemsOnLocalStorage();
    changeUI();
}, 10000);

const clearExpiredItems = () => {
    let registeredCourses = {};
    Object.keys(localStorage).forEach(function(key){
        let item = localStorage.getItem(key);
        registeredCourses[`${key}`] = item;
     });
     for(let key in registeredCourses)
     {
        let item = JSON.parse(registeredCourses[key]);
        if(new Date(item.expiry).getTime() < new Date().getTime())
        {
            console.log(item.expiry);
            localStorage.removeItem(key);
        }
     }
}
*/