import { TestBed } from '@angular/core/testing';

import { JuegoFiltradoService } from './juego-filtrado.service';

describe('JuegoFiltradoService', () => {
  let service: JuegoFiltradoService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(JuegoFiltradoService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
