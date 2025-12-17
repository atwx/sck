<div class="nav_language nav_language--sharp-dropdown">
    <% if $Locales %>
        <div class="nav-select nav_language_dropdown">
            <select data-behaviour="select-redirect" class="nav_language_button">
                <% loop $Locales %>
                    <option class="$LinkingMode nav_language_item fib fi-$UrlSegment"
                            <% if $LinkingMode == "current" %>selected<% end_if %> value="$Link">
                        $Title.XML
                    </option>
                <% end_loop %>
            </select>
        </div>
    <% end_if %>
</div>
