use std::io::{self, Write, BufWriter};
use rand::seq::SliceRandom;

#[cfg(feature = "simd")] extern crate stdsimd;
#[cfg(test)] extern crate test;
#[cfg(feature = "simd")] extern crate  faster;
#[cfg(feature = "simd")] use faster::*;


#[inline(always)]
pub fn char_to_emoji_up<'a, 'b, 'c>(buf: &'a [u8], out: &'b mut [u8], flagin: &'c [u8]) -> &'b [u8] {
    for (i, ch) in buf.iter().enumerate() {
        out[4 * i + 0] = 0xf0;
        out[4 * i + 1] = 0x9f;
        // (ch + 55) >> 6 approximates (ch + 55) / 64
        // out[4 * i + 2] = ((((*ch as u16).wrapping_add(55)) >> 6) + 143 ) as u8;
        out[4 * i + 2] = (((*ch as u16) >> 6) + 143) as u8;
        // (ch + 55) & 0x3f approximates (ch + 55) % 64
        out[4 * i + 3] = ((flagin[(*ch as usize)%47])& 0x3f).wrapping_add(128);
        // `println!("{}",out[4*i + 2]);
    }
    out
}

pub fn char_to_emoji_low<'a, 'b, 'c>(buf: &'a [u8], out: &'b mut [u8], flagin: &'c [u8]) -> &'b [u8] {
    for (i, ch) in buf.iter().enumerate() {
        out[4 * i + 0] = 0xf0;
        out[4 * i + 1] = 0x9f;
        // (ch + 55) >> 6 approximates (ch + 55) / 64
        out[4 * i + 2] = ((((flagin[(*ch as usize)%47] as u16)) >> 6) + 143) as u8;
        // (ch + 55) & 0x3f approximates (ch + 55) % 64
        out[4 * i + 3] = (ch & 0x3f).wrapping_add(128);
        // println!("{}",out[4*i + 2]);
    }
    out
}


fn main() {
   
    let mut rng = rand::thread_rng();

    // println!("{:?}",flag_shifter);

    let flag_up = vec![4, 5, 4, 4, 5, 4, 7, 3, 5, 7, 3, 6, 7, 3, 6, 5, 7, 3, 5, 7, 7, 7, 5, 3, 7, 5, 6, 3, 3, 3, 7, 5, 3, 6, 3, 5, 6, 3, 7, 6, 5, 6, 6, 3, 3, 3, 7];
   let flag_low = vec![7, 4, 14, 4, 3, 4, 15, 4, 0, 15, 0, 5, 4, 15, 4, 4, 15, 12, 3, 4, 5, 4, 15, 0, 14, 3, 15, 8, 4, 2, 4, 15, 3, 8, 4, 1, 1, 13, 2, 3, 4, 3, 4, 6, 11, 1, 15];

   let mut writer = BufWriter::new(io::stdout());
   let mut length_of_stuff = String::new();
   println!("Welcome to the discord emoji spammer tool!");
   println!("We provide random emoji for a smooth spamming experience! (Licensed under AGPL)");
   println!("But first, we need to know the length of the output you want us to give: ");
   let _b1 = std::io::stdin().read_line(&mut length_of_stuff).expect("Stupid Bugs");
   length_of_stuff.truncate(length_of_stuff.len() - 1);
   // let mut reader = Box::new(BufReader::new(io::stdin())) as Box<BufRead>;
   match length_of_stuff.trim().parse::<u32>() {
       Ok(i) => {
    println!("Enjoy spamming!");
    for _iter in 0..(i/255) {
        // println!("Input works {}", i);
         let num_read = (i%255) as usize;
         let mut read_buf: Vec<u8> = (0..num_read as u8).collect();
        read_buf.shuffle(&mut rng);
        // println!("Length of read_buf {:?}",read_buf.len());
        let mut write_buf = [0u8; 0x40000];
        writer.write_all(&char_to_emoji_up(&read_buf[..num_read/2], &mut write_buf, &flag_up[..47])[..num_read * 2]).unwrap();
        writer.write_all(&char_to_emoji_low(&read_buf[..num_read/2], &mut write_buf, &flag_low[..47])[..num_read * 2]).unwrap();
    }
    if i/255 == 0{
        // println!("Input works {}", i);
        let num_read = (i%255) as usize;
        let mut read_buf: Vec<u8> = (0..num_read as u8).collect();
        read_buf.shuffle(&mut rng);
        // println!("Length of read_buf {:?}",read_buf.len());
        let mut write_buf = [0u8; 0x40000];
        writer.write_all(&char_to_emoji_up(&read_buf[..num_read/2], &mut write_buf, &flag_up[..47])[..num_read * 2]).unwrap();
        writer.write_all(&char_to_emoji_low(&read_buf[..num_read/2], &mut write_buf, &flag_low[..47])[..num_read * 2]).unwrap();
        }
       }
       Err(_) => println!("I don't think {} is a valid integer", length_of_stuff),
   };
    
}
