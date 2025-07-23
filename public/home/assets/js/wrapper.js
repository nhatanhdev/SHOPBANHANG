document.addEventListener('DOMContentLoaded', function() {
    var lowerSlider = document.querySelector('#lower');
    var upperSlider = document.querySelector('#upper');

    document.querySelector('#two').value = numberWithDots(upperSlider.value) + ' đ' ;
    document.querySelector('#one').value = numberWithDots(lowerSlider.value) + ' đ' ;

    var lowerVal = parseInt(lowerSlider.value);
    var upperVal = parseInt(upperSlider.value);

    upperSlider.oninput = function() {
        lowerVal = (parseInt(lowerSlider.value));
        upperVal = (parseInt(upperSlider.value));

        if (upperVal < lowerVal + 4) {
            lowerSlider.value = upperVal - 4;
            if (lowerVal == lowerSlider.min) {
                upperSlider.value = 4;
            }
        }
        document.querySelector('#two').value =  numberWithDots(this.value) + ' đ';
    };

    lowerSlider.oninput = function() {
        lowerVal = (parseInt(lowerSlider.value));
        upperVal = (parseInt(upperSlider.value));
        if (lowerVal > upperVal - 4) {
            upperSlider.value = lowerVal + 4;
            if (upperVal == upperSlider.max) {
                lowerSlider.value = parseInt(upperSlider.max) - 4;
            }
        }
        document.querySelector('#one').value = numberWithDots(this.value) + ' đ';
    };

});


function numberWithDots(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
