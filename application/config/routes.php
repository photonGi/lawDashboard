<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*********************************************** FRONTEND **********************************************************/

$route['default_controller'] = 'controller_home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['home'] = 'controller_home';
$route['courses'] = 'controller_courses/courses';
$route['certificate/(:any)'] = 'controller_courses/course_detail';
$route['certificate-courses/(:any)/(:any)'] = 'controller_courses/certificateCourses';

$route['register'] = 'Controller_home/register';
$route['login'] = 'Controller_home/login';
$route['elearning'] = 'controller_home/elearning';
$route['contact'] = 'controller_home/contact';
$route['media_room'] = 'Controller_home/media_room';
$route['news_detail/(:any)'] = 'Controller_home/news_detail';
$route['about'] = 'Controller_home/about';
$route['leadership'] = 'Controller_home/leadership';
$route['affiliation'] = 'Controller_home/affiliation';
$route['codeofethics'] = 'Controller_home/codeofethics';
$route['valueofcertificate'] = 'Controller_home/valueofcertificate';
$route['qualityandinfomation'] = 'Controller_home/qualityandinfomation';
$route['certification_policy'] = 'Controller_home/certification_policy';
$route['statement_of_impartiality'] = 'Controller_home/statement_of_impartiality';
$route['irca_certification_policy'] = 'Controller_home/irca_certification_policy';
$route['complaint_and_appeal_procedure'] = 'Controller_home/complaint_and_appeal_procedure';
$route['violation_of_certificates'] = 'Controller_home/violation_of_certificates';
$route['privacy_statement'] = 'Controller_home/privacy_statement';
$route['trainingevents'] = 'Controller_home/trainingevents';
$route['e_detail/(:any)'] = 'Controller_home/event_detail';
$route['helpcenter'] = 'Controller_home/helpcenter';
$route['dashboard/(:any)']= 'Controller_home/user_dashboard';
$route['edit_profile']= 'Controller_home/edit_profile';
$route['change_password']= 'Controller_home/change_password';
$route['certificates']= 'Controller_home/certificates';
$route['enroll_courses']= 'Controller_home/enroll_courses';
/*********************************************** FRONTEND **********************************************************/

/* User Registeration/Login  module */
$route['signup'] = 'backend/Controller_UserLogin/signup';
$route['signin'] = 'backend/Controller_UserLogin/checkLogin';
$route['forgetPassword'] = "backend/Controller_UserLogin/reset_pass";
$route['resetPassword/(:any)'] = "backend/Controller_UserLogin/resetPassword";
$route['userLogout'] = "backend/Controller_UserLogin/logout";


/*********************************************** BACKEND **********************************************************/

/* admin login module */
$route['admin/login'] = "backend/controller_login";
$route['admin/getlogin'] = "backend/controller_login/checkLogin";
$route['admin/forget'] = "backend/controller_login/forgetPassword";
$route['admin/mailPassword'] = "backend/controller_login/mailPassword";
$route['restPasswordPage/(:any)/(:any)'] = "backend/controller_login/restPasswordPage";
$route['restPassword'] = "backend/controller_login/restPassword";
$route['admin/userlogout'] = "backend/controller_login/logout";
$route['admin/dashboard'] = "backend/controller_login/dashboard";

/* Administration Management */
$route['admin/listAdmin'] = "backend/controller_admin/index";
$route['admin/addAdmin'] = "backend/controller_admin/view";
$route['admin/addingAdmin'] = "backend/controller_admin/add";
$route['admin/editAdmin/(:any)'] = "backend/controller_admin/edit";
$route['admin/updateAdmin/(:any)'] = "backend/controller_admin/update";
$route['admin/deleteAdmin/(:any)'] = "backend/controller_admin/delete";
$route['admin/changeAdminStatus/(:any)/(:any)'] = "backend/controller_admin/changeStatus";
$route['admin/listAdministrationNews/(:any)'] = "backend/controller_admin/listAdministrationNews";

/* Profile Management */
$route['admin/editProfile'] = "backend/Controller_profile/editProfile";
$route['admin/updateProfile'] = "backend/Controller_profile/updateProfile";
$route['admin/editPassword'] = "backend/Controller_profile/editPassword";
$route['admin/changePassword'] = "backend/Controller_profile/updatePassword";


/* Certificates module */
$route['admin/listCategories'] = "backend/controller_certificate";
$route['admin/addCategories'] = "backend/controller_certificate/view";
$route['admin/saveCategory'] = "backend/controller_certificate/add";
$route['admin/editCategory/(:any)'] = "backend/controller_certificate/edit";
$route['admin/updateCategory/(:any)'] = "backend/controller_certificate/update";
$route['admin/deleteCategory/(:any)'] = "backend/controller_certificate/delete";

$route['admin/listCertificates/(:any)/(:any)'] = "backend/controller_certificate/certificates";
$route['admin/addCertificate/(:any)/(:any)'] = "backend/controller_certificate/addCertificate";
$route['admin/saveCertificate/(:any)/(:any)'] = "backend/controller_certificate/saveCertificate";
$route['admin/editCertificate/(:any)/(:any)/(:any)'] = "backend/controller_certificate/editCertificate";
$route['admin/updateCertificate/(:any)/(:any)/(:any)'] = "backend/controller_certificate/updateCertificate";
$route['admin/deleteCertificate/(:any)/(:any)/(:any)'] = "backend/controller_certificate/deleteCertificate";

$route['admin/listCourses/(:any)/(:any)'] = "backend/controller_certificate/listCourses";
$route['admin/addCourse/(:any)/(:any)'] = "backend/controller_certificate/addCourse";
$route['admin/saveCourse/(:any)/(:any)'] = "backend/controller_certificate/saveCourse";
$route['admin/editCourse/(:any)/(:any)/(:any)'] = "backend/controller_certificate/editCourse";
$route['admin/updateCourse/(:any)/(:any)/(:any)'] = "backend/controller_certificate/updateCourse";
$route['admin/deleteCourse/(:any)/(:any)/(:any)'] = "backend/controller_certificate/deleteCourse";

/* Customer Module  module */
$route['admin/listCustomers'] = "backend/controller_customer";
$route['admin/viewCustomer/(:any)'] = "backend/controller_customer/viewCustomer";
$route['admin/updateCustomer/(:any)'] = "backend/controller_customer/update";

/* Subscribers */
$route['admin/listSubscribers'] = "backend/Controller_subscriber";
$route['admin/deleteSubscribers/(:any)'] = "backend/Controller_subscriber/delete";
$route['admin/contactqueries'] = "backend/Controller_subscriber/contactqueries";
$route['admin/deleteMessage/(:any)'] = "backend/Controller_subscriber/deleteMessage";

/* slider  module */
$route['admin/listSliders'] = "backend/controller_slider";
$route['admin/addSlides'] = "backend/controller_slider/view";
$route['admin/saveSlides'] = "backend/controller_slider/add";
$route['admin/editSlides/(:any)'] = "backend/controller_slider/edit";
$route['admin/updateSlides/(:any)'] = "backend/controller_slider/update";
$route['admin/deleteSlides/(:any)'] = "backend/controller_slider/delete";

/* events  module */
$route['admin/eventsList'] = "backend/Controller_events/index";
$route['admin/add_events'] = "backend/Controller_events/view";
$route['admin/addingEvents'] = "backend/Controller_events/addEvent";
$route['admin/editEvents/(:any)'] = "backend/Controller_events/edit";
$route['admin/updateEvents/(:any)'] = "backend/Controller_events/update";
$route['admin/deleteEvents/(:any)'] = "backend/Controller_events/delete";
$route['admin/eventDetail/(:any)'] = "backend/Controller_events/detail_detail";

/* mediaNews  module */
$route['admin/newsList'] = "backend/controller_news";
$route['admin/addNews'] = "backend/controller_news/view";
$route['admin/saveNews'] = "backend/controller_news/add";
$route['admin/editNews/(:any)'] = "backend/controller_news/edit";
$route['admin/updateNews/(:any)'] = "backend/controller_news/update";
$route['admin/deleteNews/(:any)'] = "backend/controller_news/delete";

/*clients module*/
$route['admin/clientsList'] = "backend/Controller_UserLogin/clients";

/* Enrollments module */
$route['admin/enrollmentList'] = "backend/controller_enrollments";
$route['admin/addEnrollment'] = "backend/controller_enrollments/enrollments";

/*********************************************** BACKEND **********************************************************/