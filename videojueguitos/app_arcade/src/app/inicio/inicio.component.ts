import { Component } from '@angular/core';
import { JuegosService } from '../juegos.service';
import { GenerosService } from '../generos.service';
import { JuegoFiltradoService } from '../juego-filtrado.service';
import { TodosVotosService } from '../todos-votos.service';
import { GenerosVotosService } from '../generos-votos.service';

@Component({
  selector: 'app-inicio',
  templateUrl: './inicio.component.html',
  styleUrls: ['./inicio.component.css']
})
export class InicioComponent {
  juegos: any[] = []; 
  generos: any[]=[];
  filtrar: string = '';
  generoSeleccionado: string="0";
  votos: boolean=false;

  constructor(
    private generosVotosService:GenerosVotosService,
    private todosVotosService:TodosVotosService, 
    private juegoFiltradoService:JuegoFiltradoService,
    private generosService:GenerosService, 
    private juegosService:JuegosService) {
    
      this.recuperarJuegos();
      this.recuperarGeneros();
    }

  /**
   * Recoje los Juegos de la base de datos
   */
  recuperarJuegos() {
    //Recojer juegos
    this.juegosService.retornar().subscribe(response => {
      if (Array.isArray(response)) {
        this.juegos=response;
      } else {
        console.error('Los datos recibidos no son un array:', response);
      }
    });
  }

  /**
   * Recoje los Juegos ordenados por votos de la base de datos 
   */
  recuperarJuegosVotos() {
    //Recojer juegos
    this.todosVotosService.retornar().subscribe(response => {
      if (Array.isArray(response)) {
        this.juegos=response;
      } else {
        console.error('Los datos recibidos no son un array:', response);
      }
    });
  }

  /**
   * Recoje los Generos de la base de datos
   */
  recuperarGeneros(){
    //Recoger Generos
    this.generosService.retornar().subscribe(response => {
      if (Array.isArray(response)) {
        this.generos = response;
      } else {
        console.error('Los datos recibidos no son un array:', response);
      }
    });
  }

  /**
   * Filtra los juegos por un genero selecionado
   */
  filtrarGenero(){
    if(this.generoSeleccionado=="0"){
      if(this.votos){
        this.recuperarJuegosVotos();
      }else{
        this.recuperarJuegos();
      }
    }else{
      if(this.votos){
        this.juegoFiltradoService.retornar(this.generoSeleccionado).subscribe(response => {
          if (Array.isArray(response)) {
            this.juegos=response;
            this.juegos.sort((a, b) => (b.positivos-b.negativos) - (a.positivos-a.negativos));
          } else {
            console.error('Los datos recibidos no son un array:', response);
          }
        });
      }else{
        this.juegoFiltradoService.retornar(this.generoSeleccionado).subscribe(response => {
          if (Array.isArray(response)) {
            this.juegos=response;
          } else {
            console.error('Los datos recibidos no son un array:', response);
          }
        });
      }
      
    }
  }
  
  /**
   * Metodo que Filtra los juegos a mostrar usando una variable global de string vacio
   */
  buscar() {
    if (!this.filtrar.trim()) {
      this.recuperarJuegos();
    } else {
      this.juegos = this.juegos.filter(juego =>
        juego.nombre.toLowerCase().includes(this.filtrar.toLowerCase())
      );
    }
  }
  
}
