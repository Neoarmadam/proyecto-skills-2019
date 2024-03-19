import { Component, HostListener } from '@angular/core';

/**
 * Algo para la direcion de mi anaconda
 */
enum Direccion {
  Up,
  Down,
  Left,
  Right
}

/**
 * Interfaz de la comida
 */
interface Point {
  x: number;
  y: number;
}

@Component({
  selector: 'app-snake-game',
  templateUrl: './snake-game.component.html',
  styleUrls: ['./snake-game.component.css']
})
export class SnakeGameComponent {
  readonly gridSize = 20;
  readonly tileSize = 20;
  snake: Point[] = [];
  food: Point = { x: 0, y: 0 };
  direccion: Direccion = Direccion.Right;
  gameOver = false;
  empezar: boolean=true;
  contador=0
  constructor() {
    //this.initGame();
  }

  /**
   * Funcion que inicia el juego de la anaconda dormida
   */
  initGame(): void {
    if(this.empezar){
      this.empezar=false;
      this.contador=0;
      this.snake = [{ x: 10, y: 10 }];
      this.food = this.generateFood();
      this.direccion = Direccion.Right;
      this.gameOver = false;
      setTimeout(() => this.move(), 200);
    }
  }

  /**
   * Funcion que captura teclas del raton y las mapea
   * @param event 
   */
  @HostListener('document:keydown', ['$event'])
  handleKeyboardEvent(event: KeyboardEvent): void {
    switch (event.key) {
      case 'ArrowLeft':
        if (this.direccion !== Direccion.Down) {
          this.direccion = Direccion.Up;
        }
        break;
      case 'ArrowRight':
        if (this.direccion !== Direccion.Up) {
          this.direccion = Direccion.Down;
        }
        break;
      case 'ArrowUp':
        if (this.direccion !== Direccion.Right) {
          this.direccion = Direccion.Left;
        }
        break;
      case 'ArrowDown':
        if (this.direccion !== Direccion.Left) {
          this.direccion = Direccion.Right;
        }
        break;
    }
  }

  /**
   * Funcion que maneja el movimiento de la serpiente dependiendo
   * de la ultima tecla de movimiento presionada de mi anaconda.
   * @returns Retorna si pierdes que pierdes
   */
  move(): void {
    if (this.gameOver) {
      return;
    }
  
    const head = { ...this.snake[0] };
    switch (this.direccion) {
      case Direccion.Up:
        head.y--;
        break;
      case Direccion.Down:
        head.y++;
        break;
      case Direccion.Left:
        head.x--;
        break;
      case Direccion.Right:
        head.x++;
        break;
    }
  
    // Comprueba que la anaconda come comida
    if (head.x === this.food.x && head.y === this.food.y) {
      this.snake.unshift(head);
      this.food = this.generateFood();
      this.contador++;
    } else {
      this.snake.pop();
      this.snake.unshift(head);
    }
  
    // Comprueba si la anaconda choca
    if (head.x < 0 || head.x >= this.gridSize || head.y < 0 || head.y >= this.gridSize ||
        this.snake.slice(1).some(segment => segment.x === head.x && segment.y === head.y)) {
      this.gameOver = true;
      this.empezar=true;
      return;
    }
  
    setTimeout(() => this.move(), 200); //Velocidad del arrastre de la anaconda
  }
  
  /**
   * Funcion que duelve un objeto comida
   * @returns Durum Kebap
   */
  generateFood(): Point {
    let food: Point;
    do {
      food = {
        x: Math.floor(Math.random() * this.gridSize),
        y: Math.floor(Math.random() * this.gridSize)
      };
    } while (this.snake.some(segment => segment.x === food.x && segment.y === food.y));
    return food;
  }
  

  //Funciones que desconozco lo que hacen pero bueno, ahi estan
  isSnake(row: number, col: number): boolean {
    return this.snake.some(segment => segment.x === col && segment.y === row);
  }
  isFood(row: number, col: number): boolean {
    return this.food.x === col && this.food.y === row;
  }
  get gridSizeArray(): number[] {
    return Array(this.gridSize).fill(0).map((x, i) => i);
  }

  
}

