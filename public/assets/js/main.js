document.getElementById("profileImage").addEventListener("click", function(event) {
    event.stopPropagation();  // Prevent closing dropdown when clicking on profile image
    var dropdown = document.getElementById("dropdownMenu");
    dropdown.style.display = (dropdown.style.display === "none" || dropdown.style.display === "") ? "block" : "none";
});

// Close dropdown if clicked outside
window.addEventListener("click", function(event) {
    if (!event.target.closest('.dropdown-user')) {
        var dropdown = document.getElementById("dropdownMenu");
        dropdown.style.display = "none";
    }
});

$(document).ready(function(){
    $('.dropdown-item').on('click', function(){
        var selectedValue = $(this).data('value');
        $('#jenis-dokumen-button span').text(selectedValue);
        $('#jenis-dokumen-button').dropdown('toggle'); // Menutup dropdown setelah memilih
    });
});


