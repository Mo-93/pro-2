let openCard = null;

function toggleinfo(element) {
    let infoCard = element.querySelector('.card');
    if (infoCard.style.display === 'block' || infoCard.style.display === '') {
        infoCard.style.display = 'none';
        if (openCard && openCard !== element) {
            const cardInfo = openCard.querySelector('.card');
            cardInfo.style.display = 'none';
        }
        openCard = null;
    } else {
        infoCard.style.display = 'block';
        if (openCard !== element) {
            if (openCard) {
                const cardInfo = openCard.querySelector('.card');
                cardInfo.style.display = 'none';
            }
            openCard = element;
        }
    }
}








