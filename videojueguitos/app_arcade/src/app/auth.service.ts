import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private loginUrl = 'http://localhost:8000/api/login_check';

  constructor(private http: HttpClient) { }

  login(credentials: { username: string, password: string }): Observable<any> {
    return this.http.post(this.loginUrl, credentials);
  }
}

