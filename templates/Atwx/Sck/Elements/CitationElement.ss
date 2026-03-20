<section class="section--CitationElement $BackgroundColor $Variant <% if $SiteConfig.ColorPrimaryFontWhite %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite %>secondary-white-text<% end_if %>">
    <div class="section_content animation--$FadeInAnimation $ElementDecoration">
        <% if $ShowTitle %>
            <% if $UseH1ForTitle %>
                <h1 class="hl1 section_title">$Title</h1>
            <% else %>
                <h2 class="hl2 section_title">$Title</h2>
            <% end_if %>
        <% end_if %>
        <% if $Text %>
            <div class="section_text">
                $Text
            </div>
        <% end_if %>
        <div class="citation__list">
            <% loop $CitationItems %>
                <div class="list__item">
                    <% if $Quote %>
                        <blockquote class="quote">
                            $Quote
                        </blockquote>
                    <% end_if %>
                    <% if $Author %>
                        <% if $Top.Variant == 'variant--highlight' %>
                            <% if $Image %>
                                <div class="author__image">$Image.FocusFill(400,400)</div>
                            <% end_if %>
                            <% if $Author %>
                                <div class="author__name"><p>$Author</p></div>
                            <% end_if %>
                        <% else %>
                            <p class="citation__author"><% if $Image %>$Image.FocusFill(100,100)<% else %>- <% end_if %>$Author</p>
                        <% end_if %>
                    <% end_if %>
                </div>
            <% end_loop %>
        </div>
    </div>
</section>
