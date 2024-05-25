const contactCards = document.querySelectorAll('.contact-card');
const editModalFirstName = document.querySelector('#firstNameInput');
const editModalLastName = document.querySelector('#lastNameInput');
const editModalPhone = document.querySelector('#phoneInput');
const editModalGroup = document.querySelector('#groupInput');

const deleteButtons = document.querySelectorAll('.delete-button');

contactCards.forEach((card) => {
    card.addEventListener('click', (e) => {
        if(!e.target.closest('.buttons')) {
            window.location.href =  `details.php?id=${e.target.dataset.id}`;
        }
    })
})

deleteButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
        const card = e.target.closest('.contact-card');
        const cardId = card.dataset.id;

        fetch('handleDeleteCard.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'id': cardId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                card.remove();
            } else {
                console.log('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});