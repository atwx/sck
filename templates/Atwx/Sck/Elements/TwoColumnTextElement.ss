<div class="two-column-text-element $Layout title-vertical-$TitleVerticalPosition $BackgroundColor">
    <div class="container">
        <div class="two-column-content">
            <% if $Layout == 'title-left' %>
                <div class="title-column">
                    <% if $LeftTitle %>
                        <h2 class="element-title">$LeftTitle</h2>
                    <% end_if %>
                </div>
                <div class="text-column">
                    <% if $RightText %>
                        <div class="element-text">$RightText</div>
                    <% end_if %>
                </div>
            <% else %>
                <div class="text-column">
                    <% if $RightText %>
                        <div class="element-text">$RightText</div>
                    <% end_if %>
                </div>
                <div class="title-column">
                    <% if $LeftTitle %>
                        <h2 class="element-title">$LeftTitle</h2>
                    <% end_if %>
                </div>
            <% end_if %>
        </div>
    </div>
</div>
