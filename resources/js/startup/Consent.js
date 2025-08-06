class Consent {
    constructor() {
        const jpfAdmin = document.querySelector('#jpf-admin');
        if (jpfAdmin) { return }
        
        document.addEventListener('DOMContentLoaded', function () {
            cookieconsent.run({
                "notice_banner_type":"simple",
                "consent_type":"express",
                "palette":"light",
                "language":"en",
                "page_load_consent_levels":["strictly-necessary"],
                "notice_banner_reject_button_hide":false,
                "preferences_center_close_button_hide":false,
                "page_refresh_confirmation_buttons":false,
                "website_name":"jpf-movewithme.co.uk",
                "website_privacy_policy_url":"https://www.jpf-movewithme.co.uk/privacy-policy"
            });
        });
    }
}

export { Consent };