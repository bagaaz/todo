"use strict";

function checkTask(id) 
{
    const taskElement = document.querySelector(`[data-id="${id}"]`);
    const position = taskElement.getAttribute('data-position');
    const taskText = taskElement.querySelector('.app_body__list-item__task p').textContent;

    fetch(`/update/${id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          task: taskText,
          position: position,
          checked: true,
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        location.reload();
    })
}

function editTask(id)
{
    const taskElement = document.querySelector(`[data-id="${id}"]`);
    const position = taskElement.getAttribute('data-position');
    const taskText = taskElement.querySelector('.app_body__list-item__task p').textContent;

    const inputElement = document.createElement('input');
    inputElement.setAttribute('type', 'text');
    inputElement.setAttribute('value', taskText);
    inputElement.setAttribute('class', 'app_body__list-item__task-input');
    const widthTaskElement = taskElement.offsetWidth - 120;
    inputElement.setAttribute('style', `width: ${widthTaskElement}px`);

    const taskElementDiv = taskElement.querySelector('.app_body__list-item__task');
    taskElementDiv.querySelector('p').remove();
    taskElementDiv.appendChild(inputElement);
    inputElement.focus();

    const iconSave = document.createElement('i');
    iconSave.setAttribute('class', 'bi bi-check-lg');

    const buttonElement = document.createElement('button');
    buttonElement.setAttribute('class', 'app_body__list-item__actions__save-button');
    buttonElement.setAttribute('onclick', `updateTask(${id})`);
    buttonElement.appendChild(iconSave);

    const actionsElement = taskElement.querySelector('.app_body__list-item__actions');
    actionsElement.querySelector('.app_body__list-item__actions__check-button').remove();
    actionsElement.querySelector('.app_body__list-item__actions__edit-button').remove();

    actionsElement.insertBefore(buttonElement, actionsElement.childNodes[0]);

}

function updateTask(id)
{
    const taskElement = document.querySelector(`[data-id="${id}"]`);
    const taskInputElement = taskElement.querySelector('.app_body__list-item__task-input');
    const position = taskElement.getAttribute('data-position');
    const taskText = taskInputElement.value;

    fetch(`/update/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            task: taskText,
            position: position,
            checked: false,
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        location.reload();
    }
    )
}

function deleteTask(id) {
    fetch(`/delete/${id}`, {
        method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        location.reload();
    })
    
}