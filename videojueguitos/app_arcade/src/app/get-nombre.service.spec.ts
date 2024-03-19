import { TestBed } from '@angular/core/testing';

import { GetNombreService } from './get-nombre.service';

describe('GetNombreService', () => {
  let service: GetNombreService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(GetNombreService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
