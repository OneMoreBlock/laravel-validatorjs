"use strict";

const form = document.querySelector("#" + validatorjs.table_id);

const formData = () =>
    Object.values(form).reduce((obj, field) => {

        if(field.name == '') {
            return obj
        }

        obj[field.name] = field.value;
        return obj;
    }, {});

form.addEventListener("submit", (e) => {
    e.preventDefault();
    validateForm(formData(), validatorjs.rules, validatorjs.messages);
});

function validateForm(data, rules, messages) {
    console.log(data)
    let validation = new Validator(data, rules, messages);
    validation.setAttributeNames(validatorjs.attributes);

    removeFormErrorNodes();

    if (validation.fails()) {
        return renderErrors(validation);
    }

    eval(validatorjs.successCallback)(data)
}

function renderErrors(validation) {
    const allErrors = validation.errors.errors;

    for (const error in allErrors) {

        let formElement = form.elements[error]

        // _removeSiblingErrorNode(formElement);
        const errorNode = _createErrorNode(allErrors[error])

        formElement.parentNode.appendChild(errorNode)
        formElement.classList.add('is-invalid')
        console.log(`key ${error} value ${allErrors[error]}`);
    }
}


function _createErrorNode(error) {
    let errorNode = document.createElement('div')
    errorNode.className = 'invalid-feedback';
    errorNode.innerText = error
    return errorNode
}


function _removeSiblingErrorNode(el) {

    let errorNode = el.nextElementSibling

    if(errorNode == null) {
        return
    }

    if(!errorNode.classList.contains('invalid-feedback')) {
        return _removeSiblingErrorNode(errorNode)
    }

    return errorNode.remove();
}


function removeFormErrorNodes() {

    const excludeElements = ['hidden', 'submit'];

    for (let i = 0; i < form.elements.length; i++) {
        let el = form.elements[i]

        if(typeof el == 'undefined' || excludeElements.includes(el.type)) {
            continue;
        }

        _removeSiblingErrorNode(el)
        el.classList.remove('is-invalid');
    }
}
