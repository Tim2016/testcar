<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="account_page">
                
                    <?php wc_print_notices(); ?>
    
                    <?php do_action( 'woocommerce_before_customer_login_form' ); ?>
                
                    <div class="row">
            
                    <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
                    
                    	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 login_form">
                            
                            <div class="section-title clearfix">
                                <h5><?php _e( 'Login', 'woocommerce' ); ?></h5>
                                <hr class="custom" />
                            </div><!-- end section-title -->
                    
                    <?php else: ?>
                    
                    	<div class="col-md-4"></div><div class="col-md-4 login_form">
                            
                            <div class="section-title text-center clearfix">
                                <h5><?php _e( 'Login', 'woocommerce' ); ?></h5>
                                <hr class="custom" />
                            </div><!-- end section-title -->
                    <?php endif; ?>
                    
                       
                           
                		<form method="post" class="logregform" role="login">
                
                			<?php do_action( 'woocommerce_login_form_start' ); ?>
                            <div class="form_group">
                                <label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> </label>
                    			<div class="input_group">
                    				<input type="text" class="input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                            </div>
                            
                            <div class="form_group">
                    			<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="pull-right"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
                				<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                				<div class="input_group">
                                    <input class="input-text" type="password" name="password" id="password" />
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </div>
                            </div>
                
                			<?php do_action( 'woocommerce_login_form' ); ?>
                                
                                <div class="clear_fix">
                                    <div class="single_checkbox float_left">
                        				<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
                        				<label for="rememberme" class="inline"><?php _e( 'Remember me', 'woocommerce' ); ?></label>
                        			</div>
                                </div>
                                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                   				<input type="submit" class="btn btn-primary" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
                			
                			<?php do_action( 'woocommerce_login_form_end' ); ?>
                
                		</form>
                        
                    <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>	   
                        
                        </div>
                    
                    	<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 register_form m30">
                        
                            <div class="section-title clearfix">
                                <h5><?php _e( 'Register', 'woocommerce' ); ?></h5>
                                <hr class="custom" />
                            </div><!-- end section-title -->
                            
                            <form method="post" role="login">
                    
                    			<?php do_action( 'woocommerce_register_form_start' ); ?>
                                
                                <div class="row">
                                
                        			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                        
                        				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form_group">
                        					   <label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
                        					   <div class="input_group">
                                                    <input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                               </div>
                                            </div>
                                        </div>
                        
                        			<?php endif; ?>
                                
                                
                                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                        			     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <?php else: ?>
                                         <div class="col-md-12">
                                    <?php endif; ?>
                                        <div class="form_group">
                        				    <label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
                        				    <div class="input_group">
                                                <input type="email" class="input-text form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" /> 
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                        
                    			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                                    <div class="row">
                        				<div class="col-md-12">
                                            <div class="form_group">
                        					   <label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                        					   <div class="input_group">
                                                   <input type="password" class="input-text form-control" name="password" id="reg_password" />
                                                   <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                               </div>
                                            </div> 
                                        </div>
                                    </div>
                    			<?php endif; ?>
            
                    			<!-- Spam Trap -->
                    			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
                    
                    			<?php do_action( 'woocommerce_register_form' ); ?>
                    			<?php do_action( 'register_form' ); ?>
                    
            					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                				<input type="submit" class="btn btn-primary" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
        			        
                    			<?php do_action( 'woocommerce_register_form_end' ); ?>
            
            		      </form>
                            
                        </div>
                       
                    <?php endif; ?>
                    
                    <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>