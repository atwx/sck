<section class="section--AccordionElement $BackgroundColor $ElementDecoration animation--$FadeInAnimation <% if $SiteConfig.ColorPrimaryFontWhite %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite %>secondary-white-text<% end_if %>">
    <div class="section_content">
        <div class="section_intro">
            <% if $ShowTitle %>
                <h2 class="hl2">$Title</h2>
            <% end_if %>
            <% if $Text %>
                <p>$Text</p>
            <% end_if %>
        </div>
        <div class="section_accordion $Columns">
            <% if $Items.Count > 0 %>
                <% loop $Items %>
                    <div class="accordion_item">
                        <% if $Image %>
                            <div class="accordion_item_image">
                                $Image.FocusFillMax(800,300)
                            </div>
                        <% end_if %>
                        <h3 class="hl3">$Title</h3>
                        <% if $IntroText %>
                            <div class="accordion_item_intro">
                                $IntroText
                            </div>
                        <% end_if %>
                        <details>
                            <summary class="section_item_expand">
                                <% if $ExpandText %>
                                    <p>$ExpandText</p>
                                <% else %>
                                    <p>Mehr erfahren</p>
                                <% end_if %>
                            </summary>
                            <div class="section_item_content<% if $Image %> --withImage<% end_if %>">
                                <div class="section_item_text">
                                    $Text
                                    <% if $Button %>
                                        <% include Atwx/Sck/Includes/Button Link=$Button, BackgroundColor=$Up.BackgroundColor %>
                                    <% end_if %>
                                </div>
                            </div>
                        </details>
                    </div>
                <% end_loop %>
            <% end_if %>
        </div>
    </div>
</section>
