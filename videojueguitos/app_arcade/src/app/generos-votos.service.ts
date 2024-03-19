import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
@Injectable({
  providedIn: 'root'
})
export class GenerosVotosService {

  private urlApi = "http://127.0.0.1:8000/main/juegos/mejoresg";

  constructor(private http: HttpClient) { }

  retornar(id:string) {
    return this.http.get<any[]>(this.urlApi+id);
  }
}
