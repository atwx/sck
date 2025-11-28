<section class="section--CitationElement $BackgroundColor $ElementDecoration <% if $SiteConfig.ColorPrimaryFontWhite && $BackgroundColor == 'bgc-primary' %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite && $BackgroundColor == 'bgc-secondary' %>secondary-white-text<% end_if %><% if $CitationItems.Count == 1 %> --single-item<% end_if %>">
    <div class="section_content">        
        <% if $ShowTitle %>
            <h2 class="hl2 section_title">$Title</h2>
        <% end_if %>
        <% if $Text %>
            <div class="section_text">
                $Text
            </div>
        <% end_if %>
        <div class="citation-list">
            <% loop $CitationItems %>
                <div class="citation-item">
                    <% if $Quote %>
                        <blockquote class="citation-quote">
                            $Quote
                        </blockquote>
                    <% end_if %>
                    <% if $Author %>
                        <p class="citation-author"><% if $Image %>$Image.FocusFill(50,50)<% else %>- <% end_if %>$Author</p>
                    <% end_if %>
                </div>
            <% end_loop %>
        </div>
    </div>
</section>
