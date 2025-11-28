<div class="header_nav_strip nav_strip--$Version nav_strip--simple-navbar">
    <div class="nav_container">
        <a href="/" class="nav_brand">
            <% if $SiteConfig.WhiteLogo && $SiteConfig.Logo %>
                <img class="nav_brand_white" src="$SiteConfig.WhiteLogo.URL" alt="Cuxhaven Logo">
                <img class="nav_brand_color" src="$SiteConfig.Logo.URL" alt="Alternative Logo">
            <% else_if $SiteConfig.Logo %>
                <img class="nav_brand_color" src="$SiteConfig.Logo.URL" alt="Cuxhaven Logo">
                <img class="nav_brand_white" src="$SiteConfig.Logo.URL" alt="Cuxhaven Logo">
            <% else_if $SiteConfig.WhiteLogo %>
                <img class="nav_brand_white" src="$SiteConfig.WhiteLogo.URL" alt="Cuxhaven Logo">
                <img class="nav_brand_color" src="$SiteConfig.WhiteLogo.URL" alt="Cuxhaven Logo">
            <% else %>
                <span class="nav_brand_fallback">$SiteConfig.Title</span>
            <% end_if %>
        </a>
        <div class="nav_right">
            <div class="nav_menu_dropdown">
                <button class="nav_menu_button" data-behaviour="toggle-navigation">
                    <span class="nav_menu_icon">☰</span>
                    Menü
                </button>
                <div class="nav_menu">
                    <ul class="nav_menu_wrap">
                        <% loop $Menu(1) %>
                            <% if $MenuPosition == "main" %>
                                <li class="nav_category">
                                    <a href="$Link" class="nav_category_title nav_link--$LinkingMode">$MenuTitle</a>
                                    <% if $Children %>
                                        <ul>
                                            <% loop $Children %>
                                                <li>
                                                    <a href="$Link" class="nav_sublink nav_link--$LinkingMode">$MenuTitle</a>
                                                </li>
                                            <% end_loop %>
                                        </ul>
                                    <% end_if %>
                                </li>
                            <% end_if %>
                        <% end_loop %>
                    </ul>
                </div>
            </div>
            <div class="nav_language">
                <% if $Locales %>
                    <div class="nav-select nav_language_dropdown">
                        <select data-behaviour="select-redirect" class="nav_language_button">
                            <% loop $Locales %>
                                <option class="$LinkingMode nav_language_item"
                                        <% if $LinkingMode == "current" %>selected<% end_if %> value="$Link">
                                    $Title.XML
                                </option>
                            <% end_loop %>
                        </select>
                    </div>
                <% end_if %>
            </div>
        </div>
    </div>
</div>
