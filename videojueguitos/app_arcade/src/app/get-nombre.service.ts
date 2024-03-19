import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class GetNombreService {
  token: string="";

    headers = new HttpHeaders({
    'Authorization': `Bearer ${this.token}`
  });

  private apiUrl = 'https://127.0.0.1:8000/api/perfil';

  constructor(private http: HttpClient) {}

  // Función para obtener el nombre de usuario
  getUsername(token: string): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}`, { token });
  }
}
