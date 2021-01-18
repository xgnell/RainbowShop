let menu_options = document.querySelectorAll('#page-menu .main-menu > li');
for (let option of menu_options) {
    option.is_opened = false;
    let children = option.children;

    // Get <a> tag
    let option_name = children[0];
    // Get <ul> tag -> submenu
    let submenu = children[1];

    // Set events
    option_name.onclick = function() {
        if (option.is_opened) {
            // Close submenu
            submenu.hidden = true;
            option.is_opened = false;
        } else {
            // Open submenu
            submenu.hidden = false;
            option.is_opened = true;
        }
        
    }

}