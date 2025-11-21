<footer>
    <div class="footer_content">
        <div class="footer_contact">
            <div class="footer_contact_info">
                <div class="footer_text">Agentur für Wirtschaftsförderung Cuxhaven</div>
                <div class="footer_text">Kapitän-Alexander-Straße 1</div>
                <div class="footer_text">27472 Cuxhaven</div>
            </div>
            <div class="footer_contact_details">
                <div class="footer_text">Telefon +49 (0) 4721 / 599-70 (Stadt Cuxhaven)</div>
                <div class="footer_text">Telefon +49 (0) 4721 / 599-60 (Landkreis Cuxhaven)</div>
                <div class="footer_text">Fax +49 (0) 4721 / 599-629</div>
                <div class="footer_text">E-Mail <a href="mailto:info@afw-cuxhaven.de">info@afw-cuxhaven.de</a></div>
            </div>
        </div>
        <div class="footer_right">
            <div class="footer_logo">
                <img src="_resources/app/client/images/CUX_Marke_STADT_Wirtschaftsfoerderung.png" alt="Stadt Cuxhaven Wirtschaftsförderung" />
            </div>
            <div class="footer_menu">
                <ul role="list" class="footer_menu_list w-list-unstyled">
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
        </div>
    </div>
</footer>
