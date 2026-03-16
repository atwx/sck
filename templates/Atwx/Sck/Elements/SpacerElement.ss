<section class="section--SpacerElement $BackgroundColor $ElementDecoration animation--$FadeInAnimation spacer-element" style="<% if $HeightStyle && not $ShowTitle %>$HeightStyle<% end_if %>">
    <% if $ShowTitle %>
        <div class="section_content animation--$FadeInAnimation">
            <% if $UseH1ForTitle %>
                <h1 class="hl1 section_title">$Title</h1>
            <% else %>
                <h2 class="hl2 section_title">$Title</h2>
            <% end_if %>
        </div>
    <% end_if %>
</section>
