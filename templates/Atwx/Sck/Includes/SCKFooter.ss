<footer>
    <div class="footer_content" style="display: grid; grid-template-columns: <% loop $siteConfig.FooterColumns %> $Width <% end_loop %> 1fr;">
        <% loop SiteConfig.FooterColumns %>
            <div class="footer_column_entry" <% if $Width %>style="flex-basis: $Width;"<% end_if %>>
                <% if $ShowTitle %>
                    <h3 class="hl3 footer_column_title">$Title</h3>
                <% end_if %>
                <% if $Content %>
                    <div class="footer_text">$Content</div>
                <% end_if %>
            </div>
        <% end_loop %>
        <% if $SiteConfig.FooterLogo %>
            <div class="footer_logo">
                <img src="$SiteConfig.FooterLogo.URL" alt="Stadt Cuxhaven Wirtschaftsförderung" />
            </div>
        <% end_if %>
    </div>
    <div class="footer_content footer_menu">
        <ul role="list" class="footer_menu_list w-list-unstyled" style="justify-content: $SiteConfig.FooterMenuAlignment;">
            <li class="footer_menu_item">
                <a href="/impressum" class="footer_text">Impressum</a>
            </li>
            <li class="footer_menu_item">
                <a href="/datenschutz" class="footer_text">Datenschutz</a>
            </li>
            <% loop $Menu(1) %>
            <% if $MenuPosition == "footer" %>
            <li class="footer_menu_item">
                <a href="$Link" class="footer_text">$MenuTitle</a>
            </li>
            <% end_if %>
            <% end_loop %>
        </ul>
    </div>
</footer>
