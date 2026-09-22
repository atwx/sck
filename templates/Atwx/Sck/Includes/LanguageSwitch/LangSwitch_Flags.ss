<div class="nav_language nav_language--flags">
    <% if $Locales %>
        <div class="nav-select nav_language_dropdown">
            <select id="LanguageSelect" data-behaviour="select-redirect" class="langswitch--languages nav_language_button">
                <% loop $Locales %>
                    <option class="$LinkingMode nav_language_item"
                        <% if $LinkingMode == "current" %>selected<% end_if %> value="$Link" data-image="$FlagURL">
                        $Title.XML
                        <img src="$FlagURL" class="country"/>
                    </option>
                <% end_loop %>
            </select>
        </div>
    <% end_if %>
</div>
