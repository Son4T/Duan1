function selectSize(element, size) {
    var sizes = document.querySelectorAll('.size-options .size');
    sizes.forEach(function(size) {
        size.classList.remove('selected');
    });

    element.classList.add('selected');
    document.getElementById('selected_size').value = size;
}