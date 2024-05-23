const editButtons = document.querySelectorAll('.edit-button');
const editModalFirstName = document.querySelector('#firstNameInput');
const editModalLastName = document.querySelector('#lastNameInput');
const editModalPhone = document.querySelector('#phoneInput');
const editModalGroup = document.querySelector('#groupInput');

editButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        const contactInfo = e.target.parentNode.parentNode.querySelector('.contact-info');
        const firstName = contactInfo.querySelector('.first-name').textContent;
        const lastName = contactInfo.querySelector('.last-name').textContent;
        const phone = contactInfo.querySelector('.phone').textContent;
        const groupId_ = e.target.parentNode.parentNode.dataset.group;
        const contactId = e.target.parentNode.parentNode.dataset.id;

        editModalFirstName.value = firstName;
        editModalLastName.value = lastName;
        editModalPhone.value = phone;
        editModalGroup.value = groupId_;
    })
});