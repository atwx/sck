<div class="contact-persons-element">
    <div class="container">
        <% if $MainTitle %>
        <h2 class="main-title">$MainTitle</h2>
        <% end_if %>
        
        <div class="contact-persons-grid">
            <% if $Person1Name %>
            <div class="contact-person">
                <% if $Person1Image %>
                <div class="contact-photo">
                    <img src="$Person1Image.URL" alt="$Person1Name" loading="lazy" />
                </div>
                <% end_if %>
                
                <div class="contact-info">
                    <h3 class="contact-name">$Person1Name</h3>
                    <% if $Person1Position %>
                    <div class="contact-position">$Person1Position</div>
                    <% end_if %>
                    
                    <% if $Person1Department %>
                    <div class="contact-department">$Person1Department</div>
                    <% end_if %>
                    
                    <div class="contact-details">
                        <% if $Person1Phone %>
                        <div class="contact-phone">
                            <strong>Tel.:</strong> $Person1Phone
                        </div>
                        <% end_if %>
                        
                        <% if $Person1Mobile %>
                        <div class="contact-mobile">
                            <strong>Mobil:</strong> $Person1Mobile
                        </div>
                        <% end_if %>
                        
                        <% if $Person1Email %>
                        <div class="contact-email">
                            <a href="mailto:$Person1Email">$Person1Email</a>
                        </div>
                        <% end_if %>
                    </div>
                    
                    <div class="contact-button">
                        <span class="btn-contact">
                            > Kontakt
                        </span>
                    </div>
                </div>
            </div>
            <% end_if %>
            
            <% if $Person2Name %>
            <div class="contact-person">
                <% if $Person2Image %>
                <div class="contact-photo">
                    <img src="$Person2Image.URL" alt="$Person2Name" loading="lazy" />
                </div>
                <% end_if %>
                
                <div class="contact-info">
                    <h3 class="contact-name">$Person2Name</h3>
                    <% if $Person2Position %>
                    <div class="contact-position">$Person2Position</div>
                    <% end_if %>
                    
                    <% if $Person2Department %>
                    <div class="contact-department">$Person2Department</div>
                    <% end_if %>
                    
                    <div class="contact-details">
                        <% if $Person2Phone %>
                        <div class="contact-phone">
                            <strong>Tel.:</strong> $Person2Phone
                        </div>
                        <% end_if %>
                        
                        <% if $Person2Mobile %>
                        <div class="contact-mobile">
                            <strong>Mobil:</strong> $Person2Mobile
                        </div>
                        <% end_if %>
                        
                        <% if $Person2Email %>
                        <div class="contact-email">
                            <a href="mailto:$Person2Email">$Person2Email</a>
                        </div>
                        <% end_if %>
                    </div>
                    
                    <div class="contact-button">
                        <span class="btn-contact">
                            > Kontakt
                        </span>
                    </div>
                </div>
            </div>
            <% end_if %>
        </div>
    </div>
</div>
