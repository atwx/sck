<div class="nav_language nav_language--rounded-dropdown">
    <% if $Locales %>
        <div class="nav-select nav_language_dropdown">
            <select id="LanguageSelect" data-behaviour="select-redirect" class="langswitch--languages nav_language_button">
                <div class="select-options">
                <% loop $Locales %>
                    <option class="$LinkingMode nav_language_item"
                        <% if $LinkingMode == "current" %>selected<% end_if %> value="$Link" data-image="https://flagcdn.com/{$UrlSegment}.svg">
                        $Title.XML
                    </option>
                <% end_loop %>
            </div>
            </select>
        </div>
    <% end_if %>
</div>
