import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
@Injectable({
  providedIn: 'root'
})
export class TodosVotosService {

  private urlApi = "http://127.0.0.1:8000/main/juegos/mejores";

  constructor(private http: HttpClient) { }

  retornar() {
    return this.http.get<any[]>(this.urlApi);
  }
}
