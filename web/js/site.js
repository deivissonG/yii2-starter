$(document).ready(() => {
    let sidebarWidth = $("#sidebar").css('width');
    $('#sidebar-toggle').on('click', e => {
        sidebarWidth = $("#sidebar").css('width');
        if (document.getElementById("sidebar").style.display === 'none') {
            document.getElementById("sidebar").style.width = sidebarWidth;
            document.getElementById("sidebar").style.display = 'inline-block';
        } else {
            document.getElementById("sidebar").style.width = '0%';
            document.getElementById("sidebar").style.display = 'none';
        }
    });

    $('.nav-tabs a.nav-link').on('click', function(e) {
        e.preventDefault();
        const target = $(this).attr('href');
        $('.nav-tabs a.nav-link').removeClass('active');
        $(this).addClass('active');
        $('.tab-pane').removeClass('active');
        $('.tab-pane').removeClass('show');
        $(target).addClass('show');
        $(target).addClass('active');
    });

});

/**
 * Color mode toggler for Bootstrap 5
 */

const storedTheme = localStorage.getItem('theme')

const getPreferredTheme = () => {
    if (storedTheme) {
        return storedTheme
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
}

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
    if (storedTheme !== 'light' || storedTheme !== 'dark') {
        setTheme(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
    }
})

setTheme(getPreferredTheme());

function setTheme(theme) {
    if (theme === 'light') {
        $('#theme-toggle').html('<i data-feather="moon" class="feather-16"></i>');
    } else {
        $('#theme-toggle').html('<i data-feather="sun" class="feather-16"></i>');
    }
    $('body').attr('data-bs-theme', theme);
    feather?.replace();
}

function toggleTheme() {
    const theme = $('body').attr('data-bs-theme') === 'light' ? 'dark' : 'light';
    setTheme(theme);
    localStorage['theme'] = theme;
}

