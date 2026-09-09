<?php
/**
 * Template Name: Contact / Advisory Inquiry
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main overflow-x-hidden">

    <!-- ═══════════════════════════════════════════════════════
         PAGE HERO — full-bleed image with overlay
    ════════════════════════════════════════════════════════ -->
    <?php
    $contact_hero_bg  = get_theme_mod( 'ojis_contact_hero_bg',          OJIS_THEME_URI . '/assets/images/contact-hero.jpg' );
    $contact_headline = get_theme_mod( 'ojis_contact_hero_bg_headline',  '' );
    $contact_sub      = get_theme_mod( 'ojis_contact_hero_bg_sub',       '' );
    ?>
    <section class="page-hero relative overflow-hidden min-h-[380px] flex items-center" aria-label="<?php esc_attr_e( 'Contact page header', 'ojis-travels-theme' ); ?>">
        <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('<?php echo esc_url( $contact_hero_bg ); ?>')"
            role="img"
            aria-label="<?php esc_attr_e( 'OJIS Travels — Contact and Advisory Inquiry', 'ojis-travels-theme' ); ?>"
        ></div>
        <div class="absolute inset-0 bg-gradient-to-br from-forest/85 to-charcoal/75" aria-hidden="true"></div>
        <div class="hero-pattern absolute inset-0 opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-7xl mx-auto px-6 pt-36 pb-20 text-center w-full">
            <span class="section-eyebrow-light"><?php esc_html_e( 'Get in Touch', 'ojis-travels-theme' ); ?></span>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mt-3 mb-6">
                <?php echo esc_html( $contact_headline ?: __( 'Contact & Advisory Inquiry', 'ojis-travels-theme' ) ); ?>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
                <?php echo esc_html( $contact_sub ?: __( 'Ready to start your sustainability journey? Reach out for an advisory consultation, partnership inquiry, or any other questions.', 'ojis-travels-theme' ) ); ?>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CONTACT GRID
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-offwhite" aria-labelledby="contact-form-heading">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-16">

                <!-- ── Contact Info (left) ──────────────── -->
                <div class="lg:col-span-2 flex flex-col gap-8 reveal-element">

                    <div>
                        <span class="section-eyebrow"><?php esc_html_e( 'Reach Us', 'ojis-travels-theme' ); ?></span>
                        <h2 class="section-heading mt-2">
                            <?php esc_html_e( 'Let\'s Talk', 'ojis-travels-theme' ); ?>
                        </h2>
                        <p class="text-muted mt-4 leading-relaxed">
                            <?php esc_html_e( 'Whether you are a traveller seeking responsible travel guidance or a hospitality business looking to build a stronger sustainability strategy, we are here to help.', 'ojis-travels-theme' ); ?>
                        </p>
                    </div>

                    <!-- Contact details -->
                    <div class="flex flex-col gap-5">

                        <div class="contact-info-card">
                            <div class="contact-info-icon">
                                <span class="material-symbols-outlined text-forest text-xl" aria-hidden="true">mail</span>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-widest text-muted mb-1">
                                    <?php esc_html_e( 'Email', 'ojis-travels-theme' ); ?>
                                </p>
                                <a
                                    href="mailto:info@ojistravels.com"
                                    class="text-charcoal font-medium hover:text-forest transition-colors duration-200 text-sm"
                                >
                                    info@ojistravels.com
                                </a>
                            </div>
                        </div>

                        <div class="contact-info-card">
                            <div class="contact-info-icon">
                                <span class="material-symbols-outlined text-forest text-xl" aria-hidden="true">public</span>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-widest text-muted mb-1">
                                    <?php esc_html_e( 'Website', 'ojis-travels-theme' ); ?>
                                </p>
                                <a
                                    href="https://ojistravels.com"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-charcoal font-medium hover:text-forest transition-colors duration-200 text-sm"
                                >
                                    ojistravels.com
                                </a>
                            </div>
                        </div>

                        <div class="contact-info-card">
                            <div class="contact-info-icon">
                                <span class="material-symbols-outlined text-forest text-xl" aria-hidden="true">location_on</span>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-widest text-muted mb-1">
                                    <?php esc_html_e( 'Location', 'ojis-travels-theme' ); ?>
                                </p>
                                <p class="text-charcoal font-medium text-sm">
                                    <?php esc_html_e( 'Africa & Beyond', 'ojis-travels-theme' ); ?>
                                </p>
                            </div>
                        </div>

                        <div class="contact-info-card">
                            <div class="contact-info-icon">
                                <span class="material-symbols-outlined text-forest text-xl" aria-hidden="true">schedule</span>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-widest text-muted mb-1">
                                    <?php esc_html_e( 'Response Time', 'ojis-travels-theme' ); ?>
                                </p>
                                <p class="text-charcoal font-medium text-sm">
                                    <?php esc_html_e( 'Within 48 business hours', 'ojis-travels-theme' ); ?>
                                </p>
                            </div>
                        </div>

                    </div>

                    <!-- What to expect -->
                    <div class="bg-forest/5 border border-forest/10 rounded-2xl p-6">
                        <h3 class="font-semibold text-charcoal mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-forest text-xl" aria-hidden="true">info</span>
                            <?php esc_html_e( 'What to Expect', 'ojis-travels-theme' ); ?>
                        </h3>
                        <ul class="flex flex-col gap-3 text-sm text-muted">
                            <?php
                            $expectations = [
                                __( 'A response within 48 business hours',          'ojis-travels-theme' ),
                                __( 'A focused discovery conversation about your needs', 'ojis-travels-theme' ),
                                __( 'A clear outline of how we can help',            'ojis-travels-theme' ),
                                __( 'No obligation to proceed',                     'ojis-travels-theme' ),
                            ];
                            foreach ( $expectations as $exp ) : ?>
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-eco text-base mt-0.5 flex-shrink-0" aria-hidden="true">check_circle</span>
                                <?php echo esc_html( $exp ); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                </div>

                <!-- ── Inquiry Form (right) ──────────────── -->
                <div class="lg:col-span-3 reveal-element">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 lg:p-10">

                        <h2 id="contact-form-heading" class="text-2xl font-bold text-charcoal mb-2">
                            <?php esc_html_e( 'Send Us a Message', 'ojis-travels-theme' ); ?>
                        </h2>
                        <p class="text-muted text-sm mb-8">
                            <?php esc_html_e( 'Fill in the form below and our team will get back to you shortly.', 'ojis-travels-theme' ); ?>
                        </p>

                        <!-- Success / Error messages -->
                        <div id="contact-form-feedback" class="hidden mb-6 p-4 rounded-xl text-sm font-medium" role="alert" aria-live="polite"></div>

                        <form
                            id="advisory-contact-form"
                            class="flex flex-col gap-5"
                            novalidate
                            aria-label="<?php esc_attr_e( 'Advisory inquiry contact form', 'ojis-travels-theme' ); ?>"
                        >
                            <?php wp_nonce_field( 'ojis_nonce', 'ojis_contact_nonce' ); ?>

                            <!-- Name + Email row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div class="form-group">
                                    <label for="contact-name" class="form-label">
                                        <?php esc_html_e( 'Full Name', 'ojis-travels-theme' ); ?>
                                        <span class="text-red-500 ml-1" aria-hidden="true">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="contact-name"
                                        name="name"
                                        required
                                        autocomplete="name"
                                        placeholder="<?php esc_attr_e( 'Your full name', 'ojis-travels-theme' ); ?>"
                                        class="form-input"
                                        aria-required="true"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="contact-email" class="form-label">
                                        <?php esc_html_e( 'Email Address', 'ojis-travels-theme' ); ?>
                                        <span class="text-red-500 ml-1" aria-hidden="true">*</span>
                                    </label>
                                    <input
                                        type="email"
                                        id="contact-email"
                                        name="email"
                                        required
                                        autocomplete="email"
                                        placeholder="<?php esc_attr_e( 'your@email.com', 'ojis-travels-theme' ); ?>"
                                        class="form-input"
                                        aria-required="true"
                                    >
                                </div>
                            </div>

                            <!-- Organisation -->
                            <div class="form-group">
                                <label for="contact-org" class="form-label">
                                    <?php esc_html_e( 'Organisation / Business', 'ojis-travels-theme' ); ?>
                                    <span class="text-muted text-xs font-normal ml-1"><?php esc_html_e( '(optional)', 'ojis-travels-theme' ); ?></span>
                                </label>
                                <input
                                    type="text"
                                    id="contact-org"
                                    name="organisation"
                                    autocomplete="organization"
                                    placeholder="<?php esc_attr_e( 'Your organisation name', 'ojis-travels-theme' ); ?>"
                                    class="form-input"
                                >
                            </div>

                            <!-- Inquiry Type -->
                            <div class="form-group">
                                <label for="contact-type" class="form-label">
                                    <?php esc_html_e( 'Inquiry Type', 'ojis-travels-theme' ); ?>
                                    <span class="text-red-500 ml-1" aria-hidden="true">*</span>
                                </label>
                                <div class="relative">
                                    <select
                                        id="contact-type"
                                        name="subject"
                                        required
                                        class="form-input appearance-none pr-10"
                                        aria-required="true"
                                    >
                                        <option value="" disabled selected><?php esc_html_e( 'Select your inquiry type', 'ojis-travels-theme' ); ?></option>
                                        <option value="Advisory Consultation"><?php esc_html_e( 'Advisory Consultation',      'ojis-travels-theme' ); ?></option>
                                        <option value="Sustainable Travel"><?php esc_html_e( 'Sustainable Travel Planning',   'ojis-travels-theme' ); ?></option>
                                        <option value="Corporate Training"><?php esc_html_e( 'Corporate Training Programme',  'ojis-travels-theme' ); ?></option>
                                        <option value="Impact Assessment"><?php esc_html_e( 'Impact Assessment',             'ojis-travels-theme' ); ?></option>
                                        <option value="Partnership"><?php esc_html_e( 'Partnership Opportunity',             'ojis-travels-theme' ); ?></option>
                                        <option value="General Inquiry"><?php esc_html_e( 'General Inquiry',                 'ojis-travels-theme' ); ?></option>
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-muted text-xl pointer-events-none" aria-hidden="true">expand_more</span>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="form-group">
                                <label for="contact-message" class="form-label">
                                    <?php esc_html_e( 'Message', 'ojis-travels-theme' ); ?>
                                    <span class="text-red-500 ml-1" aria-hidden="true">*</span>
                                </label>
                                <textarea
                                    id="contact-message"
                                    name="message"
                                    required
                                    rows="6"
                                    placeholder="<?php esc_attr_e( 'Tell us about your goals, challenges, or how we can support you...', 'ojis-travels-theme' ); ?>"
                                    class="form-input resize-none"
                                    aria-required="true"
                                ></textarea>
                            </div>

                            <!-- How did you hear about us -->
                            <div class="form-group">
                                <label for="contact-source" class="form-label">
                                    <?php esc_html_e( 'How did you hear about us?', 'ojis-travels-theme' ); ?>
                                    <span class="text-muted text-xs font-normal ml-1"><?php esc_html_e( '(optional)', 'ojis-travels-theme' ); ?></span>
                                </label>
                                <div class="relative">
                                    <select id="contact-source" name="source" class="form-input appearance-none pr-10">
                                        <option value="" selected><?php esc_html_e( 'Select an option', 'ojis-travels-theme' ); ?></option>
                                        <option value="Search Engine"><?php esc_html_e( 'Search Engine',   'ojis-travels-theme' ); ?></option>
                                        <option value="Social Media"><?php esc_html_e( 'Social Media',    'ojis-travels-theme' ); ?></option>
                                        <option value="Referral"><?php esc_html_e( 'Word of Mouth / Referral', 'ojis-travels-theme' ); ?></option>
                                        <option value="LinkedIn"><?php esc_html_e( 'LinkedIn',             'ojis-travels-theme' ); ?></option>
                                        <option value="Industry Event"><?php esc_html_e( 'Industry Event',  'ojis-travels-theme' ); ?></option>
                                        <option value="Other"><?php esc_html_e( 'Other',                   'ojis-travels-theme' ); ?></option>
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-muted text-xl pointer-events-none" aria-hidden="true">expand_more</span>
                                </div>
                            </div>

                            <!-- Privacy consent -->
                            <div class="flex items-start gap-3">
                                <input
                                    type="checkbox"
                                    id="contact-consent"
                                    name="consent"
                                    required
                                    class="mt-1 w-4 h-4 rounded border-gray-300 text-forest focus:ring-forest accent-forest cursor-pointer"
                                    aria-required="true"
                                >
                                <label for="contact-consent" class="text-sm text-muted leading-relaxed cursor-pointer">
                                    <?php printf(
                                        esc_html__( 'I agree to OJIS Travels & Advisory processing my data to respond to this inquiry. See our %s.', 'ojis-travels-theme' ),
                                        '<a href="' . esc_url( home_url( '/privacy-policy' ) ) . '" class="text-forest hover:underline">' . esc_html__( 'Privacy Policy', 'ojis-travels-theme' ) . '</a>'
                                    ); ?>
                                </label>
                            </div>

                            <!-- Submit -->
                            <button
                                type="submit"
                                id="contact-submit-btn"
                                class="btn-primary w-full justify-center inline-flex items-center gap-2 py-4 text-base mt-2"
                                aria-label="<?php esc_attr_e( 'Submit advisory inquiry', 'ojis-travels-theme' ); ?>"
                            >
                                <span class="submit-text flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base" aria-hidden="true">send</span>
                                    <?php esc_html_e( 'Send Inquiry', 'ojis-travels-theme' ); ?>
                                </span>
                                <span class="loading-text hidden items-center gap-2">
                                    <span class="material-symbols-outlined text-base animate-spin" aria-hidden="true">progress_activity</span>
                                    <?php esc_html_e( 'Sending...', 'ojis-travels-theme' ); ?>
                                </span>
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         ALTERNATIVE CONTACT — PHILOSOPHY NOTE
    ════════════════════════════════════════════════════════ -->
    <section class="py-16 bg-white" aria-label="<?php esc_attr_e( 'Contact philosophy', 'ojis-travels-theme' ); ?>">
        <div class="max-w-4xl mx-auto px-6 text-center reveal-element">
            <span class="material-symbols-outlined text-eco text-4xl mb-4 block" aria-hidden="true">handshake</span>
            <p class="text-lg text-charcoal font-medium mb-2">
                <?php esc_html_e( 'We believe every conversation is an opportunity to move the needle.', 'ojis-travels-theme' ); ?>
            </p>
            <p class="text-muted leading-relaxed max-w-2xl mx-auto">
                <?php esc_html_e( 'Whether you have a fully developed plan or just a question, reach out. Our approach is practical, collaborative, and built on progress over perfection.', 'ojis-travels-theme' ); ?>
            </p>
        </div>
    </section>

</main>

<?php get_footer(); ?>
