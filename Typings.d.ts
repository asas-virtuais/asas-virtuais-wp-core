/** Using typescript helps keep track of data format */

declare namespace AsasaVirtuaisWP {

	namespace Middleware {
		namespace Elements {
			namespace Pages {
				namespace Strategies {

					type AdminStrategy = {
						add_settings_page()
						add_admin_page()
						load_admin_pages()
						load_page()
					}
				}
			}
		}
	}

	type AdminManager = Middleware.Elements.Pages.Strategies.AdminStrategy & {
	}

	type Framework = {
		admin_manager() : AdminManager
	}


}
