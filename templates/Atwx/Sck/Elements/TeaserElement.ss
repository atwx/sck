<div class="section section--TeaserElement">
    <div class="section_content">
        <% if $Title %>
            <h2 class="teaser-title">$Title</h2>
        <% end_if %>

        <% if $TeaserItems %>
            <div class="teaser-grid">
                <% loop $TeaserItems %>
                    <div class="teaser-item">
                        <% if $Image %>
                            <div class="teaser-item-image">
                                $Image.ScaleWidth(1200)
                            </div>
                        <% end_if %>

                        <div class="teaser-item-content">
                            <% if $Title %>
                                <h3 class="teaser-item-title">$Title</h3>
                            <% end_if %>

                            <% if $Content %>
                                <div class="teaser-item-text">
                                    $Content
                                </div>
                            <% end_if %>

                            <% if $Button && $Button.exists() %>
                                <%-- <div class="teaser-item-button"> --%>
                                    <% include Atwx/Sck/Includes/Button Link=$Button %>
                                <%-- </div> --%>
                            <% end_if %>
                        </div>
                    </div>
                <% end_loop %>
            </div>
        <% end_if %>
    </div>
</div>
