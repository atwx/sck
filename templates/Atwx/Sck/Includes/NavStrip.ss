<div class="header_nav_strip nav_strip--$Version">
    <div class="nav_container">
        <a href="/" class="nav_brand">
            <img class="nav_brand_white" src="_resources/app/client/images/AfW logo neu weiss.png" alt="Cuxhaven Logo"> <!-- TODO: Make Logo changeable -->
            <img class="nav_brand_color" src="_resources/app/client/images/CUX_Marke_STADT_Wirtschaftsfoerderung.png" alt="Alternative Logo"> <!-- TODO: Make Logo changeable -->
        </a>
        <div class="nav_right">
            <div class="nav_menu_dropdown">
                <button class="nav_menu_button" data-behaviour="toggle-navigation">
                    <span class="nav_menu_icon">☰</span>
                    Menü
                </button>
                <div class="nav_menu">
                    <% loop $Menu(1) %>
                        <% if $MenuPosition == "main" %>
                            <a href="$Link" class="nav_link<% if $LinkOrSection == "section" %> nav_link--active<% end_if %>">$MenuTitle</a>
                        <% end_if %>
                    <% end_loop %>
                </div>
            </div>
            <div class="nav_language">
                <div class="nav_language_dropdown">
                    <button class="nav_language_button" data-behaviour="toggle-language">
                        Deutsch
                        <span class="nav_language_arrow">▼</span>
                    </button>
                    <div class="nav_language_menu">
                        <a href="#" class="nav_language_item active">Deutsch</a>
                        <a href="#" class="nav_language_item">English</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
