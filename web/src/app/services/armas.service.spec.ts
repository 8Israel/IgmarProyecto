import { TestBed } from '@angular/core/testing';

import { ArmasService } from './armas.service';

describe('ArmasService', () => {
  let service: ArmasService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ArmasService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
