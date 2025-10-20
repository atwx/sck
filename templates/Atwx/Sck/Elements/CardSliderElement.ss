<div class="cards-slider-element">
    <div class="container">
        <% if $SliderTitle %>
            <h2 class="slider-title">$SliderTitle</h2>
        <% end_if %>

        <div class="cards-slider-wrapper">
            <div class="cards-slider"
                 data-autoplay="$Autoplay"
                 data-autoplay-speed="$AutoplaySpeed"
                 data-show-dots="$ShowDots"
                 data-show-arrows="$ShowArrows">

                <% if $Cards %>
                    <% loop $Cards %>
                    <div class="card-slide">
                        <% if $BackgroundImage %>
                            <% if $Button %>
                                <a href="$Button.URL" class="card-slide-image"
                                <% if $Button.OpenInNew %>target="_blank"<% end_if %>>
                                    <img src="$BackgroundImage.AbsoluteURL" alt="$Title" loading="lazy">
                                    <div class="card-slide-overlay"></div>
                                </a>
                            <% else %>
                                <div class="card-slide-image">
                                    <img src="$BackgroundImage.AbsoluteURL" alt="$Title" loading="lazy">
                                    <div class="card-slide-overlay"></div>
                                </div>
                            <% end_if %>
                        <% end_if %>

                        <div class="card-slide-content">
                            <% if $Title %>
                            <h3 class="card-slide-title">$Title</h3>
                            <% end_if %>

                            <% if $Content %>
                            <div class="card-slide-text">
                                <p>$Content</p>
                            </div>
                            <% end_if %>

                            <% if $Button %>
                                <% include Atwx/Sck/Includes/Button Link=$Button %>
                            <% end_if %>
                        </div>
                    </div>
                    <% end_loop %>
                <% else %>
                    <div class="card-slide card-slide-placeholder">
                        <div class="card-slide-content">
                            <h3>Noch keine Karten</h3>
                            <p>Fügen Sie Karten über das Backend hinzu.</p>
                        </div>
                    </div>
                <% end_if %>
            </div>

            <% if $ShowArrows %>
            <div class="slider-arrows">
                <button class="slider-arrow slider-arrow-prev" data-direction="prev">
                    <span>‹</span>
                </button>
                <button class="slider-arrow slider-arrow-next" data-direction="next">
                    <span>›</span>
                </button>
            </div>
            <% end_if %>

            <% if $ShowDots && $Cards.Count > 1 %>
            <div class="slider-dots">
                <% loop $Cards %>
                <button class="slider-dot<% if $IsFirst %> active<% end_if %>" data-slide="$Pos"></button>
                <% end_loop %>
            </div>
            <% end_if %>
        </div>
    </div>
</div>
