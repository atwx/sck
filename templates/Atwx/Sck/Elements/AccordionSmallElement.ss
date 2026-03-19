<section class="section--AccordionSmallElement $BackgroundColor animation--$FadeInAnimation <% if $SiteConfig.ColorPrimaryFontWhite %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite %>secondary-white-text<% end_if %>">
    <div class="section_content $ElementDecoration">
        <div class="section_intro">
            <% if $ShowTitle %>
                <% if $UseH1ForTitle %>
                    <h1 class="hl1">$Title</h1>
                <% else %>
                    <h2 class="hl2">$Title</h2>
                <% end_if %>
            <% end_if %>
            <% if $Text %>
                $Text
            <% end_if %>
        </div>
        <div class="section_accordion">
            <% if $Items.Count > 0 %>
                <% loop $Items %>
                    <div class="accordion_item">
                        <details>
                            <summary class="section_item_expand">
                                <h3 class="hl3">$Title</h3>
                            </summary>
                            <div class="section_item_content">
                                <div class="section_item_text">
                                    $Text
                                </div>
                            </div>
                        </details>
                    </div>
                <% end_loop %>
            <% end_if %>
        </div>
    </div>
</section>
