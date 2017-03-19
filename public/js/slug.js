function convertToSlug($title){
    $slug = $title
        .toLowerCase()
        .replace(/[^-,^\w ]+/g,'')
        .replace(/ +/g,'-')
        ;
    return $slug;
}

// Update value of family-slug and uri example text with value of converted family-name
$(".slugjs-name").keyup(function(){
    var $title = $(this).val();

    convertToSlug($title);

    $(".slugjs-slug").val($slug);
    $(".slugjs-uri").text($slug);
});

// Update value of uri example text with value of converted family-slug
$(".slugjs-slug").keyup(function(){
    var $title = $(this).val();

    convertToSlug($title);

    $(".slugjs-uri").text($slug);
});


// Click "Edit" slug link to show the input field
$(".slugjs-edit").on("click", function(){
    $(".slugjs-slug").slideDown("fast");
});
