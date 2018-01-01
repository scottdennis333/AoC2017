
//    public static int part2(int s1, int s2) {
//
//        long p1 = s1;
//        long p2 = s2;
//        int c = 0;
//        for (int i = 0; i < 5000000; i++) {
//            do {
//                p1 = (p1 * 16807) % 2147483647;
//            } while (p1 % 4 != 0);
//            do {
//                p2 = (p2 * 48271) % 2147483647;
//            } while (p2 % 8 != 0);
//
//            if ((p1 & 65535) == (p2 & 65535))
//                c++;
//        }
//        return c;
//
//    }
//
//}
//


public class Day15 {
	public static void main(String[] args) {
		long a = 289;
		long b = 629;
		int judge = 0;
		for(int i = 0; i < 40000000; i++){
		    a = (a * 16807) % 2147483647;
		    b = (b * 48271) % 2147483647;
		    if((a & 65535) == (b & 65535))
		        judge++;
		}
		System.out.println("Part 1: " + judge);
		
		a = 289;
		b = 629;
		judge = 0;
		
		for(int i = 0; i < 5000000; i++){
          do{
              a = (a * 16807) % 2147483647;
          }while (a % 4 != 0);
          do{
              b = (b * 48271) % 2147483647;
          }while (b % 8 != 0);

          if((a & 65535) == (b & 65535))
              judge++;
		}
		System.out.println("Part 2: " + judge);
	}
}
