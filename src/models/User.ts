import { InterestType } from '@/models/Interest';

interface PhotoType {
  url: string,
}

export interface UserType {
  id: number,
  name: string,
  age: number,
  status: string,
  photos: PhotoType[],
  about: string,
  interests: InterestType[],
}

export class User implements UserType {
  constructor(
    public readonly id: number,
    public readonly name: string,
    public readonly age = 50,
    public readonly status = 'test',
    public readonly photos: PhotoType[] = [],
    public readonly about: string,
    public readonly interests: InterestType[],
  ) {
  }
}
