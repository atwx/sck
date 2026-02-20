<section class="section--AccordionSmallElement $BackgroundColor $ElementDecoration animation--$FadeInAnimation <% if $SiteConfig.ColorPrimaryFontWhite %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite %>secondary-white-text<% end_if %>">
    <div class="section_content">
        <div class="section_intro">
            <% if $ShowTitle %>
                <h2>$Title</h2>
            <% end_if %>
            <% if $Text %>
                <p>$Text</p>
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
