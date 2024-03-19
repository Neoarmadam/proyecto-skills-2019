import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';

@Component({
  selector: 'app-monigote',
  templateUrl: './monigote.component.html',
  styleUrl: './monigote.component.css'
})
export class MonigoteComponent {
  //Cosa que coge al monigote
  @ViewChild('manigote', {static: true}) manigoteRef!: ElementRef;

  constructor() { }

  /**
   * Si lo pongo en el constructor muere todo
   */
  ngOnInit(): void {
    this.animateManigote();
  }

  /**
   * Funcion que reproduce el audio al pulsar en el monigote
   */
  reproducirAudio(): void {
    const audio = document.getElementById('audioManigote') as HTMLAudioElement;
    audio.currentTime = 0; // Reiniciar el audio si ya estaba reproduciéndose
    audio.play();
  }

  /**
   * Funcion que anima al monigote
   */
  animateManigote(): void {
    const manigote = this.manigoteRef.nativeElement;
    let x = 0;
    let y = 0;
    let deltaX = 1; 
    let deltaY = 1; 

    setInterval(() => {
      // Cambiar la posición
      x += deltaX;
      y += deltaY;

      // Aplicar la nueva posición
      manigote.style.left = x + 'px';
      manigote.style.top = y + 'px';

      // Cambiar la dirección cuando el manigote alcanza los bordes de la ventana
      if (x <= 0 || x >= window.innerWidth - manigote.offsetWidth) {
        deltaX *= -1; 
      }
      if (y <= 0 || y >= window.innerHeight - manigote.offsetHeight) {
        deltaY *= -1; 
      }
    }, 5); // Intervalo de tiempo para el movimiento
  }

}
