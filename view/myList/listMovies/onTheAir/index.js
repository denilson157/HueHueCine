const scrollOnTheAir = {
    scrollx: -800,
    setScrollx: function (value) {
        this.scrollx = value
        document.querySelector('#onTheAir').style.marginLeft = this.scrollx + 'px'
    },
    handleLeft: function () {
        let newValue = this.scrollx + Math.round(window.innerWidth / 2)
        if (newValue > 0)
            newValue = 0

        this.setScrollx(newValue)
    },
    handleRight: function (totalItems) {
        let newValue = this.scrollx - Math.round(window.innerWidth / 2)

        let listWidth = totalItems * 150;
        let calcValue = window.innerWidth - listWidth;

        if (calcValue > newValue)
            newValue = calcValue - 60

        this.setScrollx(newValue)
    }

}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelector('#onTheAir').style.width = '3000px';

    scrollOnTheAir.setScrollx(0)

});