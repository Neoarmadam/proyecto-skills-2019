import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class JuegoFiltradoService {

  private urlApi = "http://127.0.0.1:8000/main/juegos/genero";

  constructor(private http: HttpClient) { }

  retornar(id:string) {
    return this.http.get<any[]>(this.urlApi+id);
  }
}
