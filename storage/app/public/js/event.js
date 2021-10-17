'use strict'

// tab ids
let infoTab = document.getElementById('info-tab')
let previewTab = document.getElementById('preview-tab')
let ticketTab = document.getElementById('ticket-tab')
let visibilityTab = document.getElementById('visibility-tab')

// div id
let infoPreview = document.getElementById('info-preview')
let visibility = document.getElementById('visibility')
let ticket = document.getElementById('ticket')

// form ids
let editForm = document.getElementById('edit-form')
let eventName = document.getElementById('eventName')
let eventDescS = document.getElementById('eventDescS')
let urlEvent = document.getElementById('urlEvent')
let bannerImage = document.getElementById('bannerFile')
let eventDateStart = document.getElementById('eventDateStart')
let eventDateEnd = document.getElementById('eventDateEnd')

let checkbox = document.querySelector("input[name=display_title]");
let checkboxPreview = document.querySelector("input[name=display_title_preview]");

let colorGroup = document.getElementById('colorGroup');
let colorGroupPreview = document.getElementById('colorGroupPreview');

// preview ids
let eventPreview = document.getElementById('event-preview')
let eventBanner = document.getElementById('event-banner')
let eventTitle = document.getElementById('event-title')
let eventSubtitle = document.getElementById('event-subtitle')
let eventDateP = document.getElementById('event-date')


// tab js
infoTab.addEventListener("click", (event) => {
    event.preventDefault();

    infoPreview.style.display = "block";
    visibility.style.display = "none";
    ticket.style.display = "none";

    editForm.style.display = "block";
    infoTab.parentElement.classList.add("active");

    eventPreview.style.display = "none";
    previewTab.parentElement.classList.remove("active");

    ticketTab.parentElement.classList.remove("active");

    visibilityTab.parentElement.classList.remove("active");
})

previewTab.addEventListener("click", (event) => {
    event.preventDefault();

    infoPreview.style.display = "block";
    visibility.style.display = "none";
    ticket.style.display = "none";

    editForm.style.display = "none";
    infoTab.parentElement.classList.remove("active");

    eventPreview.style.display = "block";
    previewTab.parentElement.classList.add("active");

    ticketTab.parentElement.classList.remove("active");
    
    visibilityTab.parentElement.classList.remove("active");
})

visibilityTab.addEventListener("click", (event) => {
    event.preventDefault();

    infoPreview.style.display = "none";
    visibility.style.display = "block";
    ticket.style.display = "none";

    editForm.style.display = "none";
    infoTab.parentElement.classList.remove("active");

    eventPreview.style.display = "none";
    previewTab.parentElement.classList.remove("active");

    ticketTab.parentElement.classList.remove("active");

    visibilityTab.parentElement.classList.add("active");
})

ticketTab.addEventListener("click", (event) => {
    event.preventDefault();

    infoPreview.style.display = "none";
    visibility.style.display = "none";
    ticket.style.display = "block";

    editForm.style.display = "none";
    infoTab.parentElement.classList.remove("active");

    eventPreview.style.display = "none";

    previewTab.parentElement.classList.remove("active");
    ticketTab.parentElement.classList.add("active");
    visibilityTab.parentElement.classList.remove("active");
})


// preview js

eventName.addEventListener("keyup", (event) => {
    eventTitle.innerHTML = event.target.value;
})



eventDateStart.addEventListener("blur", (event) => {
    let datetimeStart = new Date(event.target.value);
    let datetimeEnd = new Date(eventDateEnd.value);
    let dateStart = `${datetimeStart.getDate()}/${datetimeStart.getMonth()}/${datetimeStart.getFullYear()}`;
    let dateEnd = `${datetimeEnd.getDate()}/${datetimeEnd.getMonth()}/${datetimeEnd.getFullYear()}`;
    eventDateP.innerHTML = `${dateStart} - ${dateEnd}`;
})

eventDateEnd.addEventListener("blur", (event) => {
    let datetimeStart = new Date(eventDateStart.value);
    let datetimeEnd = new Date(event.target.value);
    let dateStart = `${datetimeStart.getDate()}/${datetimeStart.getMonth()}/${datetimeStart.getFullYear()}`;
    let dateEnd = `${datetimeEnd.getDate()}/${datetimeEnd.getMonth()}/${datetimeEnd.getFullYear()}`;
    eventDateP.innerHTML = `${dateStart} - ${dateEnd}`;
})

checkbox.addEventListener('change', function () {
    if (this.checked) {
        eventTitle.style.display = "block";
        eventDateP.style.display = "block";
        colorGroup.style.display = "block";
    } else {
        eventTitle.style.display = "none";
        eventDateP.style.display = "none";
        colorGroup.style.display = "none";
    }
})

paraBody1.addEventListener("keyup", (event) => {
    document.getElementById('event-para-1').innerHTML = event.target.value;
})
if (paraBody4 !== null) {
    paraBody4.addEventListener("keyup", (event) => {
        document.getElementById('event-para-4').innerHTML = event.target.value;
    })
    paraBody3.addEventListener("keyup", (event) => {
        document.getElementById('event-para-3').innerHTML = event.target.value;
    })
    paraBody2.addEventListener("keyup", (event) => {
        document.getElementById('event-para-2').innerHTML = event.target.value;
    })
}
else if (paraBody3 !== null) {
    paraBody3.addEventListener("keyup", (event) => {
        document.getElementById('event-para-3').innerHTML = event.target.value;
    })
    paraBody2.addEventListener("keyup", (event) => {
        document.getElementById('event-para-2').innerHTML = event.target.value;
    })
} 
else if (paraBody2 !== null) {
    paraBody2.addEventListener("keyup", (event) => {
        document.getElementById('event-para-2').innerHTML = event.target.value;
    })
}
