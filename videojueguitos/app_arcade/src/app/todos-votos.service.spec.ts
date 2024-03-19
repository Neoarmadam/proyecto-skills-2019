import { TestBed } from '@angular/core/testing';

import { TodosVotosService } from './todos-votos.service';

describe('TodosVotosService', () => {
  let service: TodosVotosService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(TodosVotosService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
