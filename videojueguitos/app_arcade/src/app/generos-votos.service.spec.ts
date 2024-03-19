import { TestBed } from '@angular/core/testing';

import { GenerosVotosService } from './generos-votos.service';

describe('GenerosVotosService', () => {
  let service: GenerosVotosService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(GenerosVotosService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
