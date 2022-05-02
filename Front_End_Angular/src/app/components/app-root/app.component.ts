import { requestData } from './../../Models/requestData.model';
import { Customer } from './../../Models/customer.model';
import { Component } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';
import { Country } from 'src/app/Models/country.model';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {

  customers: Customer[] = [];
  countries: Country[] = [];
  validOptionList: any;
  currentPage: number = 0;
  lastPage: number = 1;
  selected_country = -1;
  selected_status = -1;

  constructor(
    private api: ApiService,
  ) {
    this.getCountriesList();
    this.getPaginatedCustomersList(1);
    this.getValidOptionList();
  }

  onOptionsSelected() {
    this.currentPage = 0;
    this.getPaginatedCustomersList(1);
  }

  getPaginatedCustomersList(nextPrevious: number) {
    this.currentPage += nextPrevious;
    const request: requestData = this.buildRequest();
    this.api.getCustomers(request).subscribe((res: any) => {
      this.customers = res.data;
      this.lastPage = res.last_page;
    })
  }

  buildRequest() {
    let request: requestData = {
      page: this.currentPage
    };

    if (this.selected_country != -1) {
      request['country_code'] = this.selected_country;
    }

    if (this.selected_status != -1) {
      request['is_valid'] = (this.selected_status == 1 ? "true" : "false");
    }
    return request;
  }

  getCountriesList() {
    this.api.getCounties().subscribe((res: any) => {
      this.countries = [
        { country_code: -1, country_name: "Show All" },
        ...res.data
      ];
    });
  }

  getValidOptionList() {
    this.validOptionList = [
      { name: 'All phone numbers', value: -1 },
      { name: 'Valid phone numbers', value: 1 },
      { name: 'Invalid phone numbers', value: 0 },
    ]
  }

}
