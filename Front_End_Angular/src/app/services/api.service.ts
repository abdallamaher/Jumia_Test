import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { requestData } from '../Models/requestData.model';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  baseUrl = "http://127.0.0.1:8000/api";

  urls = {
    Countries: `${this.baseUrl}/public/countries`,
    Customers: `${this.baseUrl}/customers`,
  };

  headers = {};

  constructor(
    private http: HttpClient
  ) { }

  getCustomers = (requestData: requestData): any => {
    return this.http
      .post<any>(
        `${this.urls.Customers}`,
        requestData,
        {
          headers: this.headers
        }
      );
  };

  getCounties = (): any => {
    return this.http
      .get(this.urls.Countries);
  };

}
