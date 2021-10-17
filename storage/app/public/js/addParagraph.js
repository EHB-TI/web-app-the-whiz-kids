'use strict'

let addParagraph = document.getElementById('addParagraph')
let extraParagraphs = document.getElementById('extraParagraphs')

let totalParagraphs = 1;
let paraBody1 = document.getElementById('paraBody1')
let paraBody2 = document.getElementById('paraBody2')
let paraBody3 = document.getElementById('paraBody3')
let paraBody4 = document.getElementById('paraBody4')

if (paraBody4 !== null) totalParagraphs = 4;
else if (paraBody3 !== null) totalParagraphs = 3;
else if (paraBody2 !== null) totalParagraphs = 2;

addParagraph.addEventListener('click', (event) => {
    event.preventDefault();
    totalParagraphs += 1
    if (totalParagraphs <= 4) {
        extraParagraphs.insertAdjacentHTML('beforeend', `<div class="form-group">
        <label for="paraBody${totalParagraphs}">Event beschrijving: Paragraaf ${totalParagraphs}</label>
        <textarea class="form-control" id="paraBody${totalParagraphs}" rows="3" name="paraBody${totalParagraphs}"></textarea>
    </div>`)

        if (totalParagraphs == 2) {
            document.getElementById('paraBody2').addEventListener("keyup", (event) => {
                document.getElementById(`event-para-2`).innerHTML = event.target.value;
            })
        } else if (totalParagraphs == 3) {
            document.getElementById('paraBody3').addEventListener("keyup", (event) => {
                document.getElementById(`event-para-3`).innerHTML = event.target.value;
            })
        } else {
            document.getElementById('paraBody4').addEventListener("keyup", (event) => {
                document.getElementById(`event-para-4`).innerHTML = event.target.value;
            })
        }
    }
})
