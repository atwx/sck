<div class="header_nav_strip nav_strip--$Version nav_strip--simple-navbar">
    <div class="nav_container">
        <a href="/" class="nav_brand">
            <% if $SiteConfig.WhiteLogo && $SiteConfig.HeaderLogo %>
                <img class="nav_brand_white" src="$SiteConfig.WhiteLogo.URL" alt="$SiteConfig.Title Logo">
                <img class="nav_brand_color" src="$SiteConfig.HeaderLogo.URL" alt="$SiteConfig.Title Logo">
            <% else_if $SiteConfig.HeaderLogo %>
                <img class="nav_brand_color" src="$SiteConfig.HeaderLogo.URL" alt="$SiteConfig.Title Logo">
                <img class="nav_brand_white" src="$SiteConfig.HeaderLogo.URL" alt="$SiteConfig.Title Logo">
            <% else_if $SiteConfig.WhiteLogo %>
                <img class="nav_brand_white" src="$SiteConfig.WhiteLogo.URL" alt="$SiteConfig.Title Logo">
                <img class="nav_brand_color" src="$SiteConfig.WhiteLogo.URL" alt="$SiteConfig.Title Logo">
            <% else %>
                <span class="nav_brand_fallback">$SiteConfig.Title</span>
            <% end_if %>
        </a>
        <div class="nav_button">
            <button class="nav_menu_button" data-behaviour="toggle-navigation">
                <span class="nav_menu_button_stripe"></span>
                <span class="nav_menu_button_stripe"></span>
                <span class="nav_menu_button_stripe"></span>
                <span class="nav_menu_button_stripe"></span>
            </button>
        </div>
        <ul class="nav_menu" style="justify-content: $SiteConfig.HeaderMenuAlignment;">
            <% loop $Menu(1) %>
                <% if $MenuPosition == "main" %>
                    <li class="nav_entry nav_entry--$LinkingMode">
                        <a href="$Link" class="nav_link nav_link--$LinkingMode">$MenuTitle</a>
                    </li>
                <% end_if %>
            <% end_loop %>
        </ul>
        <% include Atwx\Sck\Includes\LanguageSwitch\LangSwitch %>
    </div>
</div>
